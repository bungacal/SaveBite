<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display FAQ page for public users
     * Hanya menampilkan FAQ yang is_active = true
     */
    public function index()
    {
        // Ambil FAQ dari database yang aktif, diurutkan berdasarkan order_index
        $faqs = Faq::active()->ordered()->get();

        // Jika tidak ada FAQ di database, tampilkan default FAQs
        if ($faqs->isEmpty()) {
            $faqs = collect([
                (object)[
                    'id' => 1,
                    'question' => 'How to donate on this Website?',
                    'answer' => 'You can donate food by clicking on the "Donate" button in the navigation menu. Follow the simple steps to list your surplus food for donation.',
                    'is_active' => true
                ],
                (object)[
                    'id' => 2,
                    'question' => 'Are There Any Restrictions on the Types of Food?',
                    'answer' => 'Yes, there are some restrictions on the food that can be donated. We accept non-perishable food items that are not expired.',
                    'is_active' => true
                ],
                (object)[
                    'id' => 3,
                    'question' => 'How do I know my donation is safe?',
                    'answer' => 'All food donations go through a verification process. We ensure that food is within safe consumption dates.',
                    'is_active' => true
                ]
            ]);
        }

        return view('faq', compact('faqs'));
    }

    /**
     * Handle question submission from FAQ page
     */
    public function submitQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|min:10|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Get user info if logged in
            $userName = auth()->check() ? auth()->user()->name : 'Anonymous User';
            $userEmail = auth()->check() ? auth()->user()->email : 'No email provided';

            // Send email to savebite@gmail.com
            $emailData = [
                'userName' => $userName,
                'userEmail' => $userEmail,
                'userQuestion' => $request->question,
                'submittedAt' => now(),
                'userAgent' => $request->userAgent(),
                'ipAddress' => $request->ip()
            ];

            Mail::send('emails.faq-question', $emailData, function($message) use ($userEmail, $userName) {
                $message->to('savebite@gmail.com')
                        ->subject('New FAQ Question - Save Bite');
                        
                if ($userEmail !== 'No email provided') {
                    $message->replyTo($userEmail, $userName);
                }
            });

            return redirect()->route('faq')
                ->with('success', 'Thank you for your question! We have received it and will review it for our FAQ section.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sorry, there was an error submitting your question. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Display admin FAQ page
     * Menampilkan semua FAQ (aktif dan tidak aktif)
     */
    public function adminIndex()
    {
        // Ambil semua FAQ dari database, diurutkan berdasarkan order_index
        $faqs = Faq::ordered()->get();

        return view('admin.faqA', compact('faqs'));
    }

    /**
     * Store new FAQ (admin)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:500',
            'answer' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Get the next order index
            $nextOrder = Faq::max('order_index') + 1;

            Faq::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'is_active' => true,
                'order_index' => $nextOrder
            ]);

            return redirect()->route('faqA')
                ->with('success', 'FAQ added successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }

    /**
     * Update FAQ (admin)
     */
    public function update(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:500',
            'answer' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            return redirect()->route('faqA')
                ->with('success', 'FAQ updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Delete FAQ (admin)
     */
    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            return redirect()->route('faqA')
                ->with('success', 'FAQ deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Toggle FAQ status (admin)
     */
    public function toggleActive(Faq $faq)
    {
        try {
            $faq->update(['is_active' => !$faq->is_active]);
            
            $status = $faq->is_active ? 'activated' : 'deactivated';
            return redirect()->route('faqA')
                ->with('success', "FAQ {$status} successfully!");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Update FAQ order (admin) - untuk drag & drop sorting
     */
    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faq_ids' => 'required|array',
            'faq_ids.*' => 'exists:faqs,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        try {
            foreach ($request->faq_ids as $index => $faqId) {
                Faq::where('id', $faqId)->update(['order_index' => $index]);
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update order'], 500);
        }
    }
}