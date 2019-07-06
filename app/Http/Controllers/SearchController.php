<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public function SearchData(Request $request){

        $app = DB::table('applicant')
            ->select('users.*', 'applicant.applicant_id' )
            ->join('users', 'users.user_id', '=', 'applicant.user_id')
            ->where(DB::raw('CONCAT(users.first_name," ",users.last_name)'), 'like', '%'.$request->searchQuery.'%')
            ->where('applicant.job_id', '=', $request->jobId)
            ->where('applicant.current_step', '=', 'apply')
            ->where('applicant.status', '=', 'waiting')
            ->get();

        //print_r($app);

        if($request->tableName == "waitingList"){

            return response()->json($app);

        }elseif ($request->tableName == "technicalList"){
            return response()->json($app);


        }elseif($request->tableName == "interviewList"){
            return response()->json($app);


        }elseif($request->tableName == "finalList"){
            return response()->json($app);
        }else{
            return response()->json($app);
        }
    }
}
