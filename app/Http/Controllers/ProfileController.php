<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        // Update basic info first
        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'bio' => $request->input('bio'),
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $image = $request->file('profile_picture');
            $imageData = base64_encode(file_get_contents($image));
            $imageType = $image->getClientMimeType(); // Get MIME type (e.g., "image/webp")

            // Update both fields at once
            $user->update([
                'profile_picture' => $imageData,
                'profile_picture_type' => $imageType
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function destroy(Request $request)
    {
        auth()->user()->delete();

        return redirect()->route('login')->with('success', 'Account deleted successfully');
    }

    public function show(User $user)
    {
        // Fetch all users except the currently authenticated user
        $users = User::where('id', '!=', auth()->id())->get();

        // Pass the clicked user and other users to the view
        return view('pages.user-profile', compact('user', 'users'));
    }
}

