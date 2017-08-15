<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::byActivationDetails($request->email, $request->token)
            ->firstOrFail()
            ->activate();

        auth()->loginUsingId($user->id);

        return redirect()->route('home')->withSuccess('Activated. You have been signed in!');
    }
}
