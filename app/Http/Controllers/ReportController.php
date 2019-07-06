<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function ShowReport(){

//        $users = User::all()->where('role_id', '=', 'ROLE002');
//
//        foreach ($users as $user){
//            $app = new Applicant();
//            $app->applicant_id = GenerateId('applicant', 'APL');
//
//            $app->job_id = "JOB0002";
//            $app->user_id = $user->user_id;
//            $app->applied_date = now('Asia/Jakarta');
//            $app->current_step = "apply";
//            $app->status = "waiting";
//            $app->created_at = now('Asia/Jakarta');
//            $app->updated_at = now('Asia/Jakarta');
//            $app->save();
//        }
//
//        print "push sukses";
        return view('hr.report');
    }
}
