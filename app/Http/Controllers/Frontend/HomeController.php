<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//To Show on the Homepage where first user will be redirect to
class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.home'); //showing User homepage
    }
}
