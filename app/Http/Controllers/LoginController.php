<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function updateFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required'
        ]);

        auth()->user()->update(['fcm_token' => $request->fcm_token]);

        return response()->json(['message' => 'Token updated successfully']);
    }
}
