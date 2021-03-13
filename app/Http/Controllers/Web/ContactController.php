<?php

namespace App\Http\Controllers\Web;

use App\Models\Message;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $data['setting'] = Setting::get()->first();
        return view('web.contactUs.contact-us')->with($data);
    }

    public function send(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'subject' => 'required|string|min:2',
            'body' => 'required|string',
        ]);

       Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body
        ]);

        $data = [
            'msg' => 'Successfuly Send Message',
        ];


        return Response::json($data);
    }



}
