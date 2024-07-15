<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Support\Facades\Storage;

class ChapterController extends Controller
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
    public function create($courseID)
    {
        $courses = Course::all();
        $selectedCourse = Course::find($courseID);
        return view('admin.chapters.create', compact('courses', 'selectedCourse'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_link' => 'required|file|mimes:mp4,mov,avi,flv', // 20MB max
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'pdf_url' => 'nullable|file|mimes:pdf',
            'affiliate_link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle file uploads
        $imagePath = null;
        $pdfPath = null;
        $videoPath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chapter_image', 'public');
        }

        if ($request->hasFile('pdf_url')) {
            $pdfPath = $request->file('pdf_url')->store('chapter_pdfs', 'public');
        }

        if ($request->hasFile('video_link')) {
            $videoPath = $request->file('video_link')->store('chapter_videos', 'public');
        }

        // Create the chapter
        Chapter::create([
            'video_link' => $videoPath,
            'title' => $request->title,
            'course_id' => $request->course_id,
            'pdf_url' => $pdfPath,
            'affiliate_link' => $request->affiliate_link,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => 1, // default status
        ]);

        return redirect()->route('courses.edit', $request->course_id)->with('success', 'Chapter created successfully.');
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
    public function edit(Chapter $chapter)
    {
        $courses = Course::all();
        return view('admin.chapters.edit', compact('courses', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video_link' => 'nullable|mimes:mp4,mov,ogg,qt',
            'pdf_url' => 'nullable|mimes:pdf|max:10000',
            // 'affiliate_link' => '    nullable|url',
            'description' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($chapter->image) {
                Storage::delete('public/' . $chapter->image);
            }
            $imagePath = $request->file('image')->store('chapter_image', 'public');
            $chapter->image = $imagePath;
        }

        // Handle video upload
        if ($request->hasFile('video_link')) {
            // Delete old video if exists
            if ($chapter->video_link) {
                Storage::delete('public/' . $chapter->video_link);
            }
            $videoPath = $request->file('video_link')->store('chapter_videos', 'public');
            $chapter->video_link = $videoPath;
        }

        // Handle PDF upload
        if ($request->hasFile('pdf_url')) {
            // Delete old PDF if exists
            if ($chapter->pdf_url) {
                Storage::delete('public/' . $chapter->pdf_url);
            }
            $pdfPath = $request->file('pdf_url')->store('chapter_pdfs', 'public');
            $chapter->pdf_url = $pdfPath;
        }

        $chapter->title = $request->input('title');
        $chapter->course_id = $request->input('course_id');
        $chapter->affiliate_link = $request->input('affiliate_link');
        $chapter->description = $request->input('description');
        $chapter->save();

        return redirect()->route('courses.edit', $chapter->course_id)->with('success', 'Chapter updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
