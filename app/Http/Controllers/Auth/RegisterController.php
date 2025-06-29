<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /**
     * Show the registration step 1 form.
     */
    public function showRegistrationStep1()
    {
        return view('auth.sign');
    }

    /**
     * Handle step 1 form submission and show step 2.
     */
    public function handleRegistrationStep1(Request $request)
    {
        // Validate step 1 data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        // Store step 1 data in session
        Session::put('registration_data', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => $request->password, 
        ]);

        return redirect()->route('sign2');
    }

    /**
     * Show the registration step 2 form.
     */
    public function showRegistrationStep2()
    {
        // Check if step 1 data exists in session
        if (!Session::has('registration_data')) {
            return redirect()->route('sign')
                           ->with('error', 'Please complete step 1 first.');
        }

        return view('auth.sign2');
    }

    /**
     * Handle step 2 form submission and complete registration.
     */
    public function completeRegistration(Request $request)
    {
        // Check if step 1 data exists in session
        if (!Session::has('registration_data')) {
            return redirect()->route('sign')
                           ->with('error', 'Please complete step 1 first.');
        }

        // Validate step 2 data
        $validator = Validator::make($request->all(), [
            'register' => 'required|string|in:personal,organization,company',
            'province' => 'required|string',
            'city' => 'required|string',
            'subdistrict' => 'required|string',
            'postcode' => 'required|string|size:5',
            'address' => 'required|string|min:10|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        // Get step 1 data from session
        $step1Data = Session::get('registration_data');

        try {
            $userData = [
                'name' => $step1Data['name'],
                'email' => $step1Data['email'],
                'username' => $step1Data['username'],
                'password' => Hash::make($step1Data['password']),
            ];

            if (\Schema::hasColumn('users', 'phone')) {
                $userData['phone'] = $step1Data['phone'];
            }
            if (\Schema::hasColumn('users', 'register_as')) {
                $userData['register_as'] = $request->register;
            }
            if (\Schema::hasColumn('users', 'province')) {
                $userData['province'] = $request->province;
            }
            if (\Schema::hasColumn('users', 'city')) {
                $userData['city'] = $request->city;
            }
            if (\Schema::hasColumn('users', 'subdistrict')) {
                $userData['subdistrict'] = $request->subdistrict;
            }
            if (\Schema::hasColumn('users', 'postcode')) {
                $userData['postcode'] = $request->postcode;
            }
            if (\Schema::hasColumn('users', 'address')) {
                $userData['address'] = $request->address;
            }

            $user = User::create($userData);

            // Clear registration data from session
            Session::forget('registration_data');

            // Redirect to login page with success message
            return redirect()->route('login')
                           ->with('success', 'Registration successful! Please login with your credentials.');

        } catch (\Exception $e) {
            // Log the actual error for debugging
            \Log::error('Registration failed: ' . $e->getMessage());
            
            return redirect()->back()
                           ->with('error', 'Registration failed: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Clear registration session data.
     */
    public function clearRegistrationData()
    {
        Session::forget('registration_data');
        return redirect()->route('sign');
    }
}