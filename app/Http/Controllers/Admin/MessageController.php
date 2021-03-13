<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

use App\Mail\ContactResponseMail;
use Illuminate\Support\Facades\Mail;


class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::orderBy('id', 'DESC')->paginate(8);

        return view('admin.messages.index')->with($data);
    }

    public function show(Message $message)
    {
        $data['message'] = $message;
        return view('admin.messages.show')->with($data);
    }

    public function response(Message $message , Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        //send Email
        $name = $message->name;
        $title = $request->title;
        $body = $request->body;
        $receiverMail = $message->email;
        Mail::to($receiverMail)->send(new ContactResponseMail($name,$title, $body));

        $request->session()->flash('msgSend', "Message sended Successfly");
        return redirect(url("/dashboard/messages"));

    }

}
