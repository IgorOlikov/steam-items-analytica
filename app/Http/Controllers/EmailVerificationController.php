<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function sendEmailVerificationLink(Request $request)
    {
        if (auth()->user()->hasVerifiedEmail()) {

            return response(['message' => 'Email has been already verified.']);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response([
            'message' => 'A new verification link has been sent to the email address you provided during registration.',
        ]);
    }

    public function verifyEmailHashUrl(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/');
    }
}
