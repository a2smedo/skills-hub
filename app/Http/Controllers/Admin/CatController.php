<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Exception;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index()
    {
        $data['cats'] = Cat::orderBy('id', 'DESC')->paginate(6);

        return view('admin.cats.index')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
        ]);

        Cat::create([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ])
        ]);

        $request->session()->flash('msgAdd', 'Row Add Successfly');

        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cats,id',
            'nameEn' => 'required|string|max:50',
            'nameAr' => 'required|string|max:50',
        ]);

        Cat::findOrfail($request->id)->update([
            'name' => json_encode([
                'en' => $request->nameEn,
                'ar' => $request->nameAr,
            ]),
        ]);
        $request->session()->flash('msgUpdate', 'Row Updated Successfly');

        return back();
    }

    public function delete(Request $request,  Cat $cat)
    {
        try {
            $cat->delete();
            $msg = "Row Deleted Successfly";
            $request->session()->flash('msgDeleted', $msg);

        } catch (Exception $e) {
            $msg =   "Can't Delete this Row";
            $request->session()->flash('msgNoDeleted', $msg);
        };

        return back();
    }

    public function toggle(Cat $cat)
    {
        $cat->update([
            'active' => ! $cat->active
        ]);

        return back();
    }



}
