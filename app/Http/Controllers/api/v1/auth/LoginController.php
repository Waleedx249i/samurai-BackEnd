<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\LoginVerfiyNotification;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'phone' => 'numeric|required',
            'name' => 'required|max:50'
        ]);
        $user = User::firstOrCreate(['phone' => $request->phone, 'name' => $request->name]);
        if (!$user) {
            return response()->json(['message' => 'cold not create a user with phone numper'], 401);
        }
        $user->notify(new LoginVerfiyNotification());
        return response()->json(['message' => 'verify code send sucssfully']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'login_code' => 'required'
        ]);
        $user = User::where('phone', $request->phone)->where('login_code', $request->login_code)->first();

        if ($user) {
            $user->update([
                'login_code' => null,
            ]);
            return $user->createToken($request->login_code)->plainTextToken;
        } else {
            return response()->json(['message' => 'invalid verification code '], 401);
        }
    }
}
