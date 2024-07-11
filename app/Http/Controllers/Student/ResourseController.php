<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Program;
use App\Models\ChapterProgress;
use Auth;

class ResourseController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('student.resourse.index', compact('programs'));
    }

    public function search(Request $request)
    {

        $query = $request->input('query');

        $programs = Program::where('name', 'like', "%{$query}%")->get();
        $chapters = Chapter::where('title', 'like', "%{$query}%")->get();
        $pdfs = Chapter::where('pdf_url', 'like', "%{$query}%")->get();

        return response()->json([
            'programs' => $programs,
            'chapters' => $chapters,
            'pdfs' => $pdfs
        ]);
    }

    public function show($id)
    {
        $program = Program::find($id);
        $course = Course::where('program_id', $id)->get();
        // $chapters = Chapter::where('title', 'like', "%{$query}%")->get();
        return view('student.resourse.show', compact('course', 'program'));
    }

    public function showPhase($id)
    {
        $course = Course::findOrFail($id);
        $phase = Chapter::where('course_id', $id)->whereNotNull('pdf_url')->get();
        return view('student.resourse.details', compact('phase', 'course'));
    }
}

