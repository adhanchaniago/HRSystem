<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function ShowReport(){

        return view('hr.report');
    }
}
