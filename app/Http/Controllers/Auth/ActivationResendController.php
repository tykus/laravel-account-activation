<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Auth\UserRequestedActivationEmail;

class ActivationResendController extends Controller
{
    public function showResendForm()
    {
        return view('auth.activation.resend');
    }

    /**
     * @param  Illuminate\Http\Request
     * @return Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        $this->validateResendRequest($request);

        $user = User::byEmail($request->email)->inactive()->first();

        event(new UserRequestedActivationEmail($user));

        return redirect('login')->withSuccess('Found. Account activation email has been resent to your registered email address');
    }

    /**
     * Validate the requesy
     * @param  Illuminate\Http\Request
     * @return void
     */
    private function validateResendRequest($request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users'
        ], [
            'email.exists' => 'Could not find that account.'
        ]);
    }
}
