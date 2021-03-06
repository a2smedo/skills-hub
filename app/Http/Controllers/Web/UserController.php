<?php

namespace App\Http\Controllers\Web;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data['exams'] = Auth::user()->exams;
        return view('web.user.profile')->with($data);
    }
}
