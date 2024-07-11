<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', 0)->get();
        return view('admin.user.list', compact('users'));

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'is_active' => $request->status,
            // 'plan' => $request->plan,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for the image
        ]);

        // Handle profile image upload
        if ($request->hasFile('image')) {
            // Delete old profile image if exists
            if ($user->image) {
                Storage::delete($user->image); // Ensure to import `Storage` facade at the top
            }

            // Store new profile image
            $imagePath = $request->file('image')->store('profile_images', 'public');

            // Update user with new profile image path
            $user->update(['image' => $imagePath]);
        }

        // Redirect back to edit page with success message
        return redirect()->route('user.edit', $user->id)->with('success', 'User updated successfully.');
    }
    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->is_active = $request->input('is_active');
        $user->save();
        return response()->json(['message' => 'User status updated successfully']);
    }

}
