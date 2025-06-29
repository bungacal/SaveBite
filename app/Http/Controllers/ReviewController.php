<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource (for users).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvedReviews = Review::where('is_approved', true)
                                ->orderBy('submission_date', 'desc')
                                ->get();
        
        return view('review', compact('approvedReviews'));
    }

    /**
     * Handle review submission from users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'reviewing_as' => 'required|in:Food Donor,Food Receiver',
            'reviewer_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'submission_date' => 'required|date',
            'letter' => 'required|string|min:20|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $imagePath = null;
            
            // Handle image upload if provided
            if ($request->hasFile('reviewer_photo')) {
                $imagePath = $request->file('reviewer_photo')->store('reviewer-photos', 'public');
            }

            // Create review in database (pending approval)
            Review::create([
                'name' => $request->name,
                'reviewer_photo' => $imagePath,
                'reviewing_as' => $request->reviewing_as,
                'submission_date' => $request->submission_date,
                'letter' => $request->letter,
                'is_approved' => false // Needs admin approval
            ]);

            return redirect()->route('review')
                ->with('success', 'Thank you for sharing your story! Your review has been submitted and will be reviewed by our team before being published.');

        } catch (\Exception $e) {
            // Delete uploaded image if database save fails
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()->back()
                ->with('error', 'Sorry, there was an error submitting your review. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Display admin reviews page with all reviews.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        // Tampilkan semua review untuk admin
        $reviews = Review::orderBy('submission_date', 'desc')->get();
        
        return view('admin.reviewA', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage (Admin adds review).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'reviewer_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reviewing_as' => 'required|in:Food Donor,Food Receiver',
            'submission_date' => 'required|date',
            'letter' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Prepare data
            $data = $request->only(['name', 'reviewing_as', 'submission_date', 'letter']);
            
            // Handle photo upload
            if ($request->hasFile('reviewer_photo')) {
                $photoPath = $request->file('reviewer_photo')->store('reviewer-photos', 'public');
                $data['reviewer_photo'] = $photoPath;
            }

            // Add is_approved field if checkbox is checked
            $data['is_approved'] = $request->has('is_approved');

            // Create review (added by admin)
            Review::create($data);

            return redirect()->route('admin.reviewA')->with('success', 'Review added successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        // Only show approved reviews to public
        if (!$review->is_approved) {
            abort(404);
        }

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage (Admin edits review).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'reviewer_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reviewing_as' => 'required|in:Food Donor,Food Receiver',
            'submission_date' => 'required|date',
            'letter' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Prepare data
            $data = $request->only(['name', 'reviewing_as', 'submission_date', 'letter']);

            // Handle photo upload
            if ($request->hasFile('reviewer_photo')) {
                // Delete old photo if exists
                if ($review->reviewer_photo) {
                    Storage::disk('public')->delete($review->reviewer_photo);
                }
                
                $photoPath = $request->file('reviewer_photo')->store('reviewer-photos', 'public');
                $data['reviewer_photo'] = $photoPath;
            }

            // Update review
            $review->update($data);

            return redirect()->route('admin.reviewA')->with('success', 'Review updated successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Approve a review (Admin approves review).
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function approve(Review $review)
    {
        try {
            $review->update(['is_approved' => true]);
            
            return redirect()->route('admin.reviewA')->with('success', 'Review approved successfully!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage (Admin deletes review).
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        try {
            // Delete photo if exists
            if ($review->reviewer_photo) {
                Storage::disk('public')->delete($review->reviewer_photo);
            }

            // Delete review
            $review->delete();

            return redirect()->route('admin.reviewA')->with('success', 'Review deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Get reviews by role (for AJAX filtering).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $query = Review::query();

        // Filter by role
        if ($request->has('role') && $request->role !== 'all') {
            $query->where('reviewing_as', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        $reviews = $query->orderBy('submission_date', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    /**
     * Get approved reviews for API/AJAX 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApprovedReviews()
    {
        $reviews = Review::where('is_approved', true)
                        ->orderBy('submission_date', 'desc')
                        ->get()
                        ->map(function ($review) {
                            return [
                                'id' => $review->id,
                                'name' => $review->name,
                                'reviewing_as' => $review->reviewing_as,
                                'photo' => $review->reviewer_photo ? Storage::url($review->reviewer_photo) : null,
                                'date' => $review->submission_date->format('F j, Y'),
                                'letter' => $review->letter,
                                'short_letter' => \Str::limit($review->letter, 200),
                            ];
                        });

        return response()->json($reviews);
    }
}