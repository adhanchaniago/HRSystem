<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function ShowReport(){

        $ref = Applicant::all()->where('recruiter_id', '=', Auth::user()->user_id)->count();
        $acc = Applicant::all()->where('status', '=', 'accepted')->count();
        $rej = Applicant::all()->where('status', '=', 'rejected')->count();

        return view('hr.report')->with([
            'referrals' => $ref,
            'accepted' => $acc,
            'rejected' => $rej,
        ]);
    }

    public function FilterReport(Request $request){
        $monthFilter = date('m', strtotime($request->date));
        $yearFilter = date('Y', strtotime($request->date));

        $ref = DB::table('applicant')
            ->where('recruiter_id', '=', Auth::user()->user_id)
            ->whereMonth('applied_date', '=', $monthFilter)
            ->whereYear('applied_date', '=', $yearFilter)
            ->count();

        $acc = DB::table('applicant')
            ->where('status', '=', 'accepted')
            ->whereMonth('applied_date', '=', $monthFilter)
            ->whereYear('applied_date', '=', $yearFilter)
            ->count();

        $rej = DB::table('applicant')
            ->where('status', '=', 'rejected')
            ->whereMonth('applied_date', '=', $monthFilter)
            ->whereYear('applied_date', '=', $yearFilter)
            ->count();

        $data = [$acc, $rej, $ref];

        return $data;
    }

}
