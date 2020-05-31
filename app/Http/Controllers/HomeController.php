<?php

namespace App\Http\Controllers;


use Auth;

class HomeController extends Controller
{


    public function check()
    {
        $user = Auth::user();

        if (!$user)
        {
            return redirect('/login');
        }
        return redirect(Auth::user()->role);
    }
}
