<?php

namespace App\Http\Controllers;

use App\Helper\FCMHelpers;
use App\Models\User;
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
     public function testFCM(Request $request)
    {
        $user = User::find(4); // Get the specific user

        if ($user && $user->fcm_token) {
            FCMHelpers::sendNotification(
                $user->fcm_token,
                "New Ticket Created for EBill ",
                "Issue: Fun Demand"
            );
        }
    }


}
