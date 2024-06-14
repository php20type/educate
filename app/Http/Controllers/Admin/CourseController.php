<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Course;
use App\Models\Chapter;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($programId)
    {
        $programs = Program::all();
        $selectedProgram = Program::find($programId);
        return view('admin.courses.create', compact('programs', 'selectedProgram'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'program_id' => 'required|exists:programs,id',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create the course
        Course::create($validatedData);

        // Redirect back to the create form with a success message
        return redirect()->route('programs.edit', $request->program_id)->with('success', 'Course created successfully.');
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
    public function edit(Course $course)
    {
        $chapters = Chapter::where('course_id', $course->id)->get();
        $programs = Program::all();
        return view('admin.courses.edit', compact('course', 'programs', 'chapters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'program_id' => 'required|exists:programs,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($course->image) {
                $oldImagePath = public_path('images') . '/' . $course->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('course_images'), $imageName);
            $validated['image'] = $imageName;
        }

        // Update the course
        $course->update($validated);

        // Debugging info to check if course was updated
        if ($course->wasChanged()) {
            return redirect()->route('programs.edit', $request->program_id)
                ->with('success', 'Course updated successfully.');
        } else {
            return redirect()->route('programs.edit', $request->program_id)
                ->with('warning', 'No changes were made to the course.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
