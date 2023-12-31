<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit() {
        $user = Auth::guard('cms')->user();

        return view('back.profile.edit', compact('user'));
    }

    public function update(ProfileRequest $request) {
        $validated = $request->validated();

        $user = Auth::guard('cms')->user();

        $user->update($validated);

        flash('Profile Updated')->success();

        return redirect()->route('back.profile.edit');
    }
}
