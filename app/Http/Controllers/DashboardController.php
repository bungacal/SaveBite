<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Review;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the main index page for authenticated users with approved reviews
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $approvedReviews = Review::where('is_approved', true)
                                ->orderBy('submission_date', 'desc')
                                ->limit(4) 
                                ->get();

        // Return view 'index' dengan data user dan approved reviews
        return view('user.index', compact('user', 'approvedReviews'));
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            // Update user data
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            return redirect()->route('profile')
                           ->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Failed to update profile. Please try again.')
                           ->withInput();
        }
    }

    /**
     * Show the user settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    /**
     * Update user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                           ->withErrors(['current_password' => 'Current password is incorrect.'])
                           ->withInput();
        }

        try {
            // Update password
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('settings')
                           ->with('success', 'Password updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Failed to update password. Please try again.');
        }
    }

    /**
     * Get statistics for dashboard (optional method)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats()
    {
        $stats = [
            'total_reviews' => Review::count(),
            'approved_reviews' => Review::where('is_approved', true)->count(),
            'pending_reviews' => Review::where('is_approved', false)->count(),
        ];

        return response()->json($stats);
    }
}