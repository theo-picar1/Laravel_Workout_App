<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'bio' => $request->input('bio'),
        ]);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imageData = base64_encode(file_get_contents($image));

            $user->profile_picture = $imageData;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function destroy(Request $request)
    {
        auth()->user()->delete();

        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }
}

