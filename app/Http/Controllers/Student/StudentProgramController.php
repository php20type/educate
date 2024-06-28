<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Program;
use App\Models\ChapterProgress;
use Auth;

class StudentProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $programs = Program::all(); // $user ? $user->getProgramsForLoggedInUser() : collect();
        return view('student.program.index', compact('programs'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showPhases($id)
    {
        // Fetch the phase using the provided ID
        $phase = Course::findOrFail($id);
        $courses = Course::all();
        $chapters = Chapter::where('course_id', $phase->id)->get();
        // Return the view with the phase data
        return view('student.program.phases', compact('phase', 'chapters', 'courses'));
    }

    public function getChapters($courseId)
    {
        $chapters = Chapter::where('course_id', $courseId)->get();
        return response()->json($chapters);
    }

    public function markChapterCompleted(Request $request, $chapterId)
    {
        $user = auth()->user();
        $chapter = Chapter::findOrFail($chapterId);

        $progress = ChapterProgress::updateOrCreate(
            ['student_id' => $user->id, 'chapter_id' => $chapter->id],
            ['completed' => true]
        );

        return response()->json(['success' => true]);
    }

    public function getNextChapter($courseId, $currentChapterId)
    {
        $chapters = Chapter::where('course_id', $courseId)->get();
        $currentChapter = $chapters->find($currentChapterId);
        $nextChapter = $chapters->where('id', '>', $currentChapterId)->first();

        if ($nextChapter) {
            return response()->json($nextChapter);
        } else {
            return response()->json(null);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}

