<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\penagihan;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $tl_penagihan   = penagihan::count();
        $tl_user        = user::count()-1;
        return view('dashboard', compact('tl_penagihan','tl_user'));
    }
}
