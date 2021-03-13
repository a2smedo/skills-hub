<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class Icons extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $data['icon'] = Setting::get()->first();


        return view('components.icons')->with($data);
    }
}
