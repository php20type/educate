<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Course;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Store a newly created program in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for the image
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('program_images', 'public');
        }

        // Create a new program
        $program = new Program();
        $program->name = $request->input('name');
        $program->description = $request->input('description');
        $program->image = $imagePath; // Save the image path if an image was uploaded

        // Save the program to the database
        $program->save();

        // Redirect to the index page with a success message
        return redirect()->route('programs.index')->with('success', 'Program added successfully.');

    }

    public function edit(Program $program)
    {
        $course = Course::where('program_id', $program->id)->get();
        return view('admin.programs.edit', compact('program', 'course'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $program->name = $request->name;
        $program->description = $request->description;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $program->image = $imageName;
        }

        $program->save();

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

}
