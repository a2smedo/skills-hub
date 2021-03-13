<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index()
    {
        return ExamResource::collection(Exam::get());
    }


    public function show($id)
    {
        $exam = Exam::findOrFail($id);
        return new ExamResource($exam);

    }


    public function showQuest($id)
    {
        $exam = Exam::with("questions")->findOrFail($id);
        return new ExamResource($exam);
    }


    public function start($examId, Request $request)
    {
      //  dd($request->user());



        $request->user()->exams()->attach($examId);

        return response()->json([
            'message' => 'you strarted exam'
        ]);

       // $id = Exam::findOrfail($examId);

        // if (! $user->exams()->contains($exam->id)) {
        //     $user->exams()->attach($exam->id);
        // } else {
        //     $user->exams()->updateExistingPivot($exam->id,[
        //         'status' => 'closed',
        //     ]);
        // }

        // $request->session()->flash('prev', "start/$exam->id");
        // return redirect(url("exam/questions/$exam->id"));
    }



    public function submit(Request $request, $id)
    {


        $validator = Validator::make($request->all(),[
            'ans' => 'required|array',
            'ans.*' => 'required|in:1,2,3,4',
        ]);

        if ($validator->fails()) {
            return  response()->json($validator->errors());
        }


        $exam = Exam::findOrfail($id);

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


        $user = $request->user();
        $pivotRow = $user->exams()->where('exam_id', $id)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submittime = Carbon::now();
        $timeMins = $submittime->diffInMinutes($startTime);


        if ($timeMins > $pivotRow->duration_mins) {
            $score = 0;
        }


        $user->exams()->updateExistingPivot( $id, [
            'score' => $score,
            'time_mins' => $timeMins,
        ]);

        $totalScore = number_format($score, 2);


        return response()->json([
            'message' => "you send this Rasult and your score is $totalScore %"
        ]);
       
    }

}
