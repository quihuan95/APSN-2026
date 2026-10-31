<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function hoChiMinh(): View
    {
        return view('pages.ho-chi-minh');
    }

    public function rex(): View
    {
        return view('pages.rex');
    }

    public function satellite(): View
    {
        return view('pages.blank');
    }
};
