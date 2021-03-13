<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function set($lang, Request $request)
    {
        $m_lang = ['en', 'ar'];

        if(! in_array($lang, $m_lang)) {
            $lang = 'en';
        }

        $request->session()->put('lang', $lang);

        return back();
    }
}
