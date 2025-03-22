<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Inertia\Inertia;

class ProfileViewController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)
            ->with(['profile', 'posts.community'])
            ->firstOrFail();
    
        return Inertia::render('Profile', ['user' => $user]);
    }
    
    public function edit() { 
        $user = Auth::user(); 
        return Inertia::render('ProfileEdit', ['user' => $user]); 
    }

    public function update(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:1000',
        ]);
    
        // Get the authenticated user and their profile
        $user = Auth::user();
        $profile = $user->profile;
    
        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = 'profile_picture_' . $user->id . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('storage');
    
            // Move the uploaded file
            $file->move($destinationPath, $fileName);
    
            // Save the file path to the database
            $profile->profile_picture = 'storage/' . $fileName;
        }
    
        // Handle the cover photo upload
        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $fileName = 'cover_photo_' . $user->id . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('storage');
    
            // Move the uploaded file
            $file->move($destinationPath, $fileName);
    
            // Save the file path to the database
            $profile->cover_photo = 'storage/' . $fileName;
        }
    
        // Update the bio
        $profile->bio = $request->input('bio');
    
        // Save the updated profile
        $profile->save();
    
        // Redirect back with success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }  
}
