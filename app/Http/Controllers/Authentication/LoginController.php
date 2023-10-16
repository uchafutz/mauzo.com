<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken(Random::generate());
            $user = User::find(Auth::id());

            if (request()->wantsJson()) {
                return response([
                    'token' => $token->plainTextToken,
                    'user' => $user,
                ], 200);
            }
        } else {
            return response([
                'data' => 'Invalid credentials'
            ], 400);
        }
    }
}
