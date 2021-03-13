<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{

    public function index()
    {
        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(6);
        $data['cats'] = Cat::select("id", "name")->active()->get();

        return view('admin.skills.index')->with($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

       $path = Storage::putFile("skills" , $request->file('img'));
        Skill::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),

            'cat_id' => $request->cat_id,
            'img' => $path,
        ]);

        $request->session()->flash('msgAdd', 'Row Add Successfly');

        return back();

    }



    public function update(Request $request )
    {


        $request->validate([
            'id' => 'required|exists:skills,id',
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
            'img' => 'nullable|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

        $skill = Skill::findOrfail($request->id);
        $path = $skill->img;
        if ($request->hasFile('img')) {
            Storage::delete($path);
            $path = Storage::putFile("skills" , $request->file('img'));
        }
        $skill->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),

            'cat_id' => $request->cat_id,
            'img' => $path,
        ]);
        $request->session()->flash('msgUpdate', 'Row Updated Successfly');

        return back();

    }


    public function delete(Request $request,  Skill $skill)
    {
        try {
            $path = $skill->img;
            $skill->delete();
            Storage::delete($path);
            $msg = "Row Deleted Successfly";
            $request->session()->flash('msgDeleted', $msg);

        } catch (Exception $e) {
            $msg =   "Can't Delete this Row";
            $request->session()->flash('msgNoDeleted', $msg);
        };

        return back();
    }


    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => ! $skill->active
        ]);

        return back();
    }
}
