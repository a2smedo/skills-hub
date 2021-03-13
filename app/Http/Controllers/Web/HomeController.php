<?php

namespace App\Http\Controllers\Web;

use App\Models\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $exams = Exam::select("*")->active()->get();
        return view('web.home.index');
    }


    public function load_more(Request $request)
    {
        if ($request->ajax()) {

            if ($request->id) {
                $exams = Exam::where('id', '>', $request->id)->active()->orderBy('id', 'DESC')->limit(8)->get();
            } else {

                $exams = Exam::orderBy('id', 'DESC')->limit(8)->active()->get();
            }
        }

        return view('web.home.more_data', ['exams' => $exams]);
    }



    // random data from table

    // public function load_more(Request $request)
    // {
    //     if ($request->ajax()) {

    //         if ($request->id) {
    //             $exams = Exam::where('id', '>', $request->id)->active()->inRandomOrder()->limit(8)->get();
    //         } else {

    //             $exams = Exam::inRandomOrder()->limit(8)->active()->get();
    //         }
    //     }

    //     return view('web.home.more_data', ['exams' => $exams]);
    // }


}
