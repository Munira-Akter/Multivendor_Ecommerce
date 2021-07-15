<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //Home Page load
    public function index(){
        return view('forntend.index');
    }


}
