<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ])->validate();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->withErrors(['Unauthenticated.']);
        }

    }

    public function storeApi(Request $request)
    {
        $validator = validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            $token = Auth::user()->createToken('myApp')->accessToken;
            return response()->json(['token' => $token, 'user' => Auth::user()], 200);
        } else {
            return response()->json(['error' => ['Unauthenticated']], 400);
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }
}
