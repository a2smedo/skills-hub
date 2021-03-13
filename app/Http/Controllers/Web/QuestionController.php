<?php

namespace App\Http\Controllers\Web;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{


    public function show(Exam $exam, Request $request)
    {
        $examId = $exam->id;
        if (session('prev') !== "start/$examId") {
            return redirect(url("exam/$examId"));
        }

        $questions = $exam->questions()->get();

        $request->session()->flash('prev', "questions/$examId");

        return view('web.questions.show', [
            'exam' => $exam,
            'questions' => $questions,
        ]);
    }


    public function sendExam(Request $request,  Exam $exam)
    {
        $examId = $exam->id;
        if (session('prev') !== "questions/$examId") {
            return redirect(url("exam/$examId"));
        }

        $request->validate([
            'ans' => 'required|array',
            'ans.*' => 'required|in:1,2,3,4',
        ]);

        $points = 0;
        $totalQusetionsNum = $exam->questions()->count();

        foreach ($exam->questions as $question) {
            if (isset($request->ans[$question->id])) {
                $userAns = $request->ans[$question->id];
                $rightAns = $question->right_ans;
                if($userAns == $rightAns){
                    $points +=1;
                }

            }
        }

        $score = ($points / $totalQusetionsNum) * 100;

        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submittime = Carbon::now();
        $timeMins = $submittime->diffInMinutes($startTime);


        if ($timeMins > $pivotRow->duration_mins) {
            $score = 0;
        }


        $user->exams()->updateExistingPivot( $examId, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);

        $totalScore = number_format($score, 2);

        $request->session()->flash("success", "You finished exam Successfly with score $totalScore %");
        return redirect(url("exam/$examId"));

    }


    public function cancelExam(Request $request,  Exam $exam)
    {
        $examId = $exam->id;
        $request->validate([
            'exam_id' => 'required'
        ]);

        if (session('prev') !== "questions/$examId") {
            return redirect(url("exam/$examId"));
        }

        $score = 0;
        $timeMins = 0;
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);

        $totalScore = number_format($score, 2);

        $request->session()->flash("lost", "You are canceled this exam, and your score $totalScore");
        return redirect(url("exam/$examId"));
    }
}
