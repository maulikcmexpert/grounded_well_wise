<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoreController extends Controller
{

    public function currentServertime(Request $request)
    {
        $request->session()->put('currentTime', $request->timezone);
    }
}
