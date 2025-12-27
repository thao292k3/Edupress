<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssessmentQuestion;
use Illuminate\Support\Facades\Auth;

class InstructorAssessmentController extends Controller
{
    public function index()
    {
        $questions = AssessmentQuestion::orderBy('id', 'asc')->get();
        return view('backend.instructor.assessments.index', compact('questions'));
    }

    public function create()
    {
        return view('backend.instructor.assessments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'options_text' => 'required|string',
            'correct_option' => 'nullable|string',
        ]);

        $lines = array_filter(array_map('trim', explode("\n", $data['options_text'])));
        $options = [];
        foreach ($lines as $line) {
            
            $parts = array_map('trim', explode('|', $line));
            $text = $parts[0] ?? '';
            $weight = isset($parts[1]) ? (int)$parts[1] : 1;
            $level = $parts[2] ?? null;
            $options[] = ['text' => $text, 'weight' => $weight, 'level' => $level];
        }

        AssessmentQuestion::create([
            'instructor_id' => Auth::id(),
            'question' => $data['question'],
            'options' => $options,
            'correct_option' => $data['correct_option'] ?? null,
        ]);

        return redirect()->route('instructor.assessments.index')->with('success', 'Question added');
    }

    public function edit($id)
    {
        $q = AssessmentQuestion::findOrFail($id);
        return view('backend.instructor.assessments.edit', compact('q'));
    }

    public function update(Request $request, $id)
    {
        $q = AssessmentQuestion::findOrFail($id);
        $data = $request->validate([
            'question' => 'required|string',
            'options_text' => 'required|string',
            'correct_option' => 'nullable|string',
        ]);

        $lines = array_filter(array_map('trim', explode("\n", $data['options_text'])));
        $options = [];
        foreach ($lines as $line) {
            $parts = array_map('trim', explode('|', $line));
            $text = $parts[0] ?? '';
            $weight = isset($parts[1]) ? (int)$parts[1] : 1;
            $level = $parts[2] ?? null;
            $options[] = ['text' => $text, 'weight' => $weight, 'level' => $level];
        }

        $q->update([
            'question' => $data['question'],
            'options' => $options,
            'correct_option' => $data['correct_option'],
        ]);
        return redirect()->route('instructor.assessments.index')->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $q = AssessmentQuestion::findOrFail($id);
        $q->delete();
        return back()->with('success', 'Deleted');
    }
}
