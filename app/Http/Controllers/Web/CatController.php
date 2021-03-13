<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{

    public function show(Cat $cat)
    {
        $data['cat'] = $cat;
        $data['cats'] = Cat::select('id', 'name')->active()->get();
        $data['skills'] = $data['cat']->skills()->active()->paginate(3);

        return view('web.cats.show')->with($data) ;
    }


}
