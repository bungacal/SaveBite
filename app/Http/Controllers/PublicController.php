<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class PublicController extends Controller
{
    /**
     * Show the public homepage with approved reviews
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $approvedReviews = Review::where('is_approved', true)
                                ->orderBy('submission_date', 'desc')
                                ->limit(4)
                                ->get();

        // Return view untuk guest/public
        return view('welcome', compact('approvedReviews'));
    }

    /**
     * Show all approved reviews for public (optional)
     *
     * @return \Illuminate\Http\Response
     */
    public function allReviews()
    {
        $approvedReviews = Review::where('is_approved', true)
                                ->orderBy('submission_date', 'desc')
                                ->paginate(12);

        return view('public.reviews', compact('approvedReviews'));
    }
}