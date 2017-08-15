<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('activation_token', $request->token)
            ->where('email', $request->email)
            ->firstOrFail()
            ->activate();

        auth()->loginUsingId($user->id);

        return redirect()->route('home')->withSuccess('Activated. You have been signed in!');
    }
}
