<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // `password` is cast as `hashed` in the User model, so we must store plain text.
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        auth()->login($user);

        return redirect()->route('home')->with('success', 'تم إنشاء الحساب بنجاح!');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'بيانات الدخول غير صحيحة',
            ])->withInput();
        }

        auth()->login($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');


    }

    public function logout(Request $request)
    {
        $token = $request->user()?->currentAccessToken();
        $token?->delete();

        auth()->logout(); // إضافة تسجيل الخروج من session

        return redirect()->route('login.form')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}

