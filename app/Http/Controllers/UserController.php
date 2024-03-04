<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;      
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule; 
use App\Models\User; 
use App\Models\ProfilePhoto;   

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => ['required', Rule::in([1, 2, 3])], // Role ID must be 1, 2, or 3
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        // Redirect back with a success message
        return redirect()->route('administrator.create.user')->with('success', 'User registered successfully!');
    }
     
    public function updateProfile(Request $request)
    {
        try {
            // Validate the incoming request data, including the 2MB file size limit
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . auth()->user()->id,
                //'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB limit (2048 KB)
            ]);
    
            // Get the authenticated user
            $user = Auth::user();
    
            // Store the old photo paths
            //$oldPhotoPath = $user->profilePhoto->photo_path ?? null;
            //$oldThumbnailPath = $user->profilePhoto->thumbnail_path ?? null;
    
            // Update the user's name and email
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);
    
            // Handle profile photo upload
            /*
            if ($request->hasFile('profile_photo')) {
                $photo = $request->file('profile_photo');
                
                try {
                    // Check the file size
                    if ($photo->getSize() > 2048000) { // 2MB in bytes (1024 KB * 2)
                        throw new PostTooLargeException('Profile photo must not exceed 2MB in size.');
                    }
    
                    // Generate a unique filename for the thumbnail
                    $thumbnailFilename = uniqid('thumbnail_') . '.' . $photo->getClientOriginalExtension();
    
                    // Resize and save the thumbnail
                    $thumbnail = Image::make($photo)->resize(100, 100)->save(public_path('thumbnails/' . $thumbnailFilename));
    
                    // Save the original photo
                    $photoPath = $photo->store('profile_photos', 'public');
    
                    // Update or create the profile photo record
                    ProfilePhoto::updateOrcreate(
                        ['user_id' => $user->id],
                        ['photo_path' => $photoPath, 'thumbnail_path' => 'thumbnails/' . $thumbnailFilename]
                    );
    
                    // Delete the old profile photo and its thumbnail if they exist
                    if ($oldPhotoPath) {
                        File::delete(storage_path($oldPhotoPath));
                    }
                    if ($oldThumbnailPath) {
                        File::delete(public_path($oldThumbnailPath));
                    }

                } catch (PostTooLargeException $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
            */
    
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            // Handle any other exceptions that may occur during the update process
            return redirect()->back()->with('error', 'Profile update failed: ' . $e->getMessage());
        }
    }
    
    // Trigger Password Reset Email
    public function sendPasswordResetEmail(Request $request)
    {
        $user = Auth::user();

        // Send a password reset email to the user's email address
        Password::sendResetLink($user->only('email'));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Password reset link sent to your email.');
    }
}
