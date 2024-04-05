<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function sendEmailVerificationLink(Request $request)
    {
        if (auth()->user()->hasVerifiedEmail()) {

            return response(['message' => 'Email has been already verified'],200);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response([
            'message' => 'A new verification link has been sent to the email address you provided during registration.',
        ]);
    }

    public function verifyEmailHashUrl(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return response(['message' => 'Email has been verified']);
    }
}
