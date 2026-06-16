<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Setting;
use App\Mail\ContactFormMail;
use App\Mail\ContactAutoReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:150',
            'email'   => 'required|email|max:150',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // Save to database
        $contactMessage = ContactMessage::create($validated);

        $adminEmail = Setting::get('admin_email', config('mail.from.address'));

        // Notify admin
        try {
            Mail::to($adminEmail)->send(new ContactFormMail($contactMessage));
        } catch (\Exception $e) {
            Log::error('Admin contact mail failed: ' . $e->getMessage());
        }

        // Auto-reply to sender
        try {
            Mail::to($validated['email'])->send(new ContactAutoReply($contactMessage));
        } catch (\Exception $e) {
            Log::error('Auto-reply mail failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent. We will get back to you shortly!');
    }
}
