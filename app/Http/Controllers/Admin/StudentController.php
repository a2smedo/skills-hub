<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $studentRole = Role::where("name", "student")->first();
        $data['students'] = User::where("role_id", $studentRole->id)
                            ->orderBy('id', 'Desc')
                            ->paginate(10);

        return view('admin.students.index')->with($data);
    }


    public function showScore($id)
    {
        $student = User::findOrFail($id);

        if ($student->role->name !== "student") {
            return back();
        }

        $data['student'] = $student;
        $data['exams'] = $student->exams;

        return view('admin.students.show-scores')->with($data);
    }

    public function openExam($userId, Exam $exam)
    {
        $student = User::findOrFail($userId);
        if ($student->role->name !== "student") {
            return back();
        }

        $student->exams()->updateExistingPivot($exam->id, [
            'status' => 'opened'
        ]);

        return back();
    }


    public function closeExam($userId, Exam $exam)
    {
        $student = User::findOrFail($userId);
        if ($student->role->name !== "student") {
            return back();
        }

        $student->exams()->updateExistingPivot($exam->id, [
            'status' => 'closed'
        ]);

        return back();
    }
}
