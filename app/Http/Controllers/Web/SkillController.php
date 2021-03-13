<?php

namespace App\Http\Controllers\Web;

use App\Models\Skill;


use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function show(Skill $skill)
    {
        $data['skill'] = $skill;
        $data['exams'] = $data['skill']->exams()->active()->paginate(4);
        return view("web.skills.show")->with($data) ;

    }

}
