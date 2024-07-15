<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($programId)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('student.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Retrieve authenticated user

        // Validate form inputs
        $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'phone' => 'nullable',
            'country' => 'nullable',
            'city' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'about_me' => 'nullable|string',
            'educate_community_profile' => 'nullable|string',
            'instagram_profile' => 'nullable|string',
            'twitter_profile' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Max 2MB file size
        ]);

        // Update user model attributes
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $user['email'];
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->about_me = $request->input('about_me');
        $user->educate_community_profile = $request->input('educate_community_profile');
        $user->instagram_profile = $request->input('instagram_profile');
        $user->twitter_profile = $request->input('twitter_profile');

        // Handle profile image upload if provided
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            $oldImagePath = storage_path('app/public/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('public/profile_images');
            $user->image = str_replace('public/', '', $imagePath);
        }

        // Save the updated user data
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
