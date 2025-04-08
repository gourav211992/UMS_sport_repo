<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class SportsResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/sports/dashboard';

    public function __construct()
    {
        $this->middleware('guest:sports');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('ums.sports.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }
}