<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit() {
        return view('back.password.edit');
    }

    public function update(Request $request) {
        $validated = $request->validate([
            'old_password' => 'required|current_password:cms',
            'password' => 'required|min:6|confirmed'
        ], [
            'old_password.current_password' => 'The old password is incorrect.'
        ]);

        Auth::guard('cms')->user()->update([
            'password' => Hash::make($validated['password'])
        ]);

        flash('Password Changed.')->success();

        return redirect()->route('back.password.edit');
    }
}
