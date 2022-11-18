<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

class VerifyEmailController extends Controller
{

    public function sendVerificationEmail() {
        request()->user()->sendEmailVerificationNotification();
        return response([
                'message' => 'Request has been sent!',
            ]);
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        if ($user->hasVerifiedEmail()) {
            return [
                'message' => 'Email already verified'
            ];
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        
        return redirect('http://localhost:4200');
        // return [
        //     'message'=>'Email has been verified'
        // ];
    }
}