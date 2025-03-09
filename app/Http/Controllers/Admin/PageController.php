<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Redirects to the login page if the user is not logged in, otherwise
     * displays the dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('pages.dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
