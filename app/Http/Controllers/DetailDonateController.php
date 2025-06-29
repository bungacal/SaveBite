<?php

namespace App\Http\Controllers;

use App\Models\DetailDonate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class DetailDonateController extends Controller
{
    /**
     * Display public donation listings (for user/browse page).
     *
     * @return \Illuminate\Http\Response
     */
    public function publicIndex()
    {
        $donations = DetailDonate::available()->orderBy('created_at', 'desc')->get();
        return view('user.browse', compact('donations'));
    }

    /**
     * Display admin donation management page (browseA).
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        $donations = DetailDonate::orderBy('created_at', 'desc')->get();
        return view('admin.browseA', compact('donations'));
    }

    /**
     * Show the form for creating a new donation - Step 2 (browseA2).
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep2()
    {
        return view('admin.browseA2');
    }

    /**
     * Handle step 2 form submission and show step 3.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donor_name' => 'required|string|max:255',
            'donor_address' => 'required|string|max:500',
            'donor_contact' => 'required|string|max:20',
            'pickup_method' => 'required|in:delivery,self-pickup',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store step 2 data in session
        session(['donation_step2' => $request->all()]);

        return redirect()->route('browseA3');
    }

    /**
     * Show step 3 form (browseA3).
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep3()
    {
        // Check if step 2 data exists
        if (!session('donation_step2')) {
            return redirect()->route('browseA2')->with('error', 'Please complete step 2 first.');
        }

        return view('admin.browseA3');
    }

    /**
     * Store the final donation data (from browseA3).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'food_name' => 'required|string|max:255',
            'food_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'portion_quantity' => 'required|integer|min:1',
            'best_within' => 'required|string|regex:/^\d{2}\/\d{2}\/\d{4}$/', // MM/DD/YYYY 
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Get data from step 2
            $step2Data = session('donation_step2');
            
            if (!$step2Data) {
                return redirect()->route('browseA2')->with('error', 'Session expired. Please start again.');
            }

            // Prepare final data
            $donationData = array_merge($step2Data, $request->only(['food_name', 'portion_quantity', 'best_within']));

            // Handle image upload
            if ($request->hasFile('food_photo')) {
                $imagePath = $request->file('food_photo')->store('donations', 'public');
                $donationData['food_photo'] = $imagePath;
            }

            // Set default status
            $donationData['status'] = DetailDonate::STATUS_AVAILABLE;

            // Create donation
            DetailDonate::create($donationData);

            // Clear session data
            session()->forget(['donation_step2']);

            return redirect()->route('browseA')->with('success', 'Food donation added successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Update donation status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailDonate  $donation
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, DetailDonate $donation)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:available,claimed,completed,expired',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try {
            $donation->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Donation status updated successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified donation.
     *
     * @param  \App\Models\DetailDonate  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailDonate $donation)
    {
        try {
            // Delete image if exists
            if ($donation->food_photo) {
                Storage::disk('public')->delete($donation->food_photo);
            }

            $donation->delete();
            return redirect()->route('browseA')->with('success', 'Donation deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Show donation details for claiming (modal or separate page).
     *
     * @param  \App\Models\DetailDonate  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(DetailDonate $donation)
    {
        return response()->json([
            'success' => true,
            'donation' => $donation
        ]);
    }

    /**
     * Handle food claiming by users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailDonate  $donation
     * @return \Illuminate\Http\Response
     */
    public function claim(Request $request, DetailDonate $donation)
    {
        // Validate user is logged in
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first to claim food.'
            ], 401);
        }

        // Check if donation is still available
        if ($donation->status !== DetailDonate::STATUS_AVAILABLE) {
            return response()->json([
                'success' => false,
                'message' => 'This donation is no longer available.'
            ], 400);
        }

        try {
            // Update status to claimed
            $donation->update([
                'status' => DetailDonate::STATUS_CLAIMED,
                // You can add claimer_id if you have user relationship
                // 'claimer_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Food donation claimed successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function handleDonateStep1(Request $request)
    {
        // Simpan data sementara di session
        $request->session()->put('donation_data', $request->only([
            'name', 'contact', 'address', 'donatur_type'
        ]));

        return redirect()->route('donate2');
    }

    public function showDonateStep2()
    {
        return view('user.donate2'); 
    }

    public function sendDonationEmail(Request $request)
    {
        $data = session('donation_data');
        $additional = $request->only(['food_description', 'pickup_time']);

        $allData = array_merge($data, $additional);

        // Kirim email ke savebite@gmail.com
        Mail::raw(
            "Donasi Baru:\n\n" . 
            "Nama: {$allData['name']}\n" .
            "Kontak: {$allData['contact']}\n" .
            "Alamat: {$allData['address']}\n" .
            "Tipe Donatur: {$allData['donatur_type']}\n" .
            "Deskripsi Makanan: {$allData['food_description']}\n" .
            "Waktu Penjemputan: {$allData['pickup_time']}",
            function ($message) {
                $message->to('savebite@gmail.com')
                        ->subject('Donasi Baru dari Website Save Bite');
            }
        );

        // Hapus session
        $request->session()->forget('donation_data');

        return redirect()->route('donate')->with('success', 'Donasi berhasil dikirim!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailDonate  
     * @return \Illuminate\Http\Response
     */

    public function meal()
    {
        $allDonates = DetailDonate::all();
        $foods = DetailDonate::where('status', 'available')->get();
        return view('user.meal', compact('foods'));
    }

    public function nearme()
    {
        $foods = DetailDonate::where('status', 'available')->get();
        return view('user.nearme', compact('foods'));
    }
}