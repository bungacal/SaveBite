<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Send contact email to savebite@gmail.com
     */
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Mail::send('emails.contact', [
                'userName' => $request->name,
                'userEmail' => $request->email,
                'userSubject' => $request->subject,
                'userMessage' => $request->message,
            ], function($message) use ($request) {
                $message->to('savebite@gmail.com')
                        ->subject('Contact Form: ' . $request->subject)
                        ->replyTo($request->email, $request->name);
            });

            return redirect()->route('contact')
                ->with('success', 'Thank you for contacting us! Your message has been sent successfully. We will get back to you soon.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                ->withInput();
        }
    }
}