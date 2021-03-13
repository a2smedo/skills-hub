<?php

namespace App\Http\Controllers\Admin;

use App\Events\ExamAddedEvent;
use App\Models\Exam;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::orderBy('id', 'DESC')->paginate(9);
        return view('admin.exams.index')->with($data);
    }

    public function show(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('admin.exams.show-exam')->with($data);
    }


    public function create()
    {
        $data['skills'] = Skill::select("id", "name")->get();
        return view('admin.exams.create')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'descEn' => 'required|string',
            'descAr' => 'required|string',
            'img' => 'required|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'question_no' => 'required|integer|min:1',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
        ]);


        $path = Storage::putFile("exams", $request->file('img'));
        $exam =  Exam::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'desc' => json_encode([
                'en' => $request->descEn,
                'ar' => $request->descAr,
            ]),

            'img' => $path,
            'skill_id' => $request->skill_id,

            'question_no' => $request->question_no,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'active' => 0,
        ]);

        $request->session()->flash('prev', "exam/$exam->id");
        $request->session()->flash('msgAdd', 'Row Add Successfly');

        return redirect(url("dashboard/exams/questions/create/$exam->id"));
    }

    public function edit(Exam $exam)
    {
        $data['exam'] = $exam;
        $data['skills'] = Skill::select("id", "name")->get();
        return view('admin.exams.edit')->with($data);
    }

    public function update(Request $request, Exam $exam)
    {

        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'descEn' => 'required|string',
            'descAr' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',
        ]);

        $path = $exam->img;

        if ($request->hasFile('img')) {
            Storage::delete($path);
            $path = Storage::putFile("exams", $request->file('img'));
        }

        $exam->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
            'desc' => json_encode([
                'en' => $request->descEn,
                'ar' => $request->descAr,
            ]),

            'img' => $path,

            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,

        ]);

        $request->session()->flash('msgUpdate', 'Row Updated Successfly');
        $request->session()->flash('msgUpdate', 'Row Updated Successfly');

        return redirect(url("dashboard/exams/show/$exam->id"));
    }

    public function delete(Exam $exam , Request $request)
    {
        try {
            $path = $exam->img;
            $exam->questions()->delete();
            $exam->delete();
            Storage::delete($path);

            $msg = "Row Deleted Successfly";
            $request->session()->flash('msgDeleted', $msg);

        } catch (Exception $e) {
            $msg =   "Can't Delete this Row";
            $request->session()->flash('msgNoDeleted', $msg);
        }
        return back();
    }

    public function toggle(Exam $exam)
    {

        if ($exam->question_no == $exam->questions()->count()) {

            $exam->update([
                'active' => ! $exam->active
            ]);
        }

        return back();
    }



    //Questions

    public function showQuest(Exam $exam)
    {
        $data['exam'] = $exam;
        $data['questions'] = $exam->questions();
        return view('admin.exams.showQuest')->with($data);
    }


    public function createQuest(Exam $exam, Request $request)
    {
        if (session('prev') !== "exam/$exam->id" and session('current') !== "exam/$exam->id") {

            return redirect(url("/dashboard/exams"));
        }

        $data['exam_id'] = $exam->id;
        $data['question_no'] = $exam->question_no;



        return view('admin.exams.createQuest')->with($data);
    }

    public function storeQuest(Request $request, Exam $exam)
    {
        $request->session()->flash('current', "exam/$exam->id");

        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:300',

            'right_ans' => 'required|array',
            'right_ans.*' => 'required|in:1,2,3,4',

            'option_1' => 'required|array',
            'option_1.*' => 'required|string|max:255',

            'option_2' => 'required|array',
            'option_2.*' => 'required|string|max:255',

            'option_3' => 'required|array',
            'option_3.*' => 'required|string|max:255',

            'option_4' => 'required|array',
            'option_4.*' => 'required|string|max:255',

        ]);


        for ($i = 0; $i < $exam->question_no; $i++) {
            Question::create([
                'exam_id' => $exam->id,
                'title' => $request->titles[$i],
                'option_1' => $request->option_1[$i],
                'option_2' => $request->option_2[$i],
                'option_3' => $request->option_3[$i],
                'option_4' => $request->option_4[$i],
                'right_ans' => $request->right_ans[$i],
            ]);
        }

        $exam->update([
            'active' => 1,
        ]);

        $request->session()->flash('msgAdd', 'Questions Add Successfly');

        event(new ExamAddedEvent);

        return redirect(url("/dashboard/exams"));
    }


    public function editQuest(Exam $exam, Question $question)
    {
        $data['exam'] = $exam;
        $data['ques'] = $question;

        return view('admin.exams.editQuest')->with($data);
    }
    public function updateQuest(Request $request, Exam $exam, Question $question)
    {
      $data =  $request->validate([
            'title' => 'required|string|max:300',
            'right_ans' => 'required|in:1,2,3,4',
            'option_1' => 'required|string|max:255',
            'option_2' => 'required|string|max:255',
            'option_3' => 'required|string|max:255',
            'option_4' => 'required|string|max:255',

        ]);

      $question->update($data);

      $request->session()->flash('msgUpdate', 'Questions Updated Successfly');
      return redirect(url("dashboard/exams/show/$exam->id/questions"));

    }
}
