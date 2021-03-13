<?php

namespace App\Http\Controllers\Web;

use App\Models\Exam;

use App\Models\Skill;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show(Request $request, Exam $exam)
    {
        $data['exam'] = $exam;
        $data['skills'] = Skill::select('id', 'name', 'cat_id')->active()->get();

        $user = Auth::user();
        $data['canEnterExam'] = true;
        $examId = $exam->id;



        if ($user !== null) {

            $pivotRow = $user->exams()->active()->where('exam_id', $examId )->first();

            if ($pivotRow !== null and $pivotRow->pivot->status == 'closed'  ) {
                $data['canEnterExam'] = false;

            }
        }


       return view("web.exams.show")->with($data);
    }

    public function start(Exam $exam, Request $request)
    {
        $user = Auth::user();
        if (! $user->exams()->contains($exam->id)) {
            $user->exams()->attach($exam->id);
        } else {
            $user->exams()->updateExistingPivot($exam->id,[
                'status' => 'closed',
            ]);
        }

        $request->session()->flash('prev', "start/$exam->id");
        return redirect(url("exam/questions/$exam->id"));
    }
}
