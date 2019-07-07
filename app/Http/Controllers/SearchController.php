<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //
    public function SearchData(Request $request){




        if($request->tableName == "waitingList")
        {
            $app = DB::table('applicant')
                ->select('users.*', 'applicant.applicant_id' )
                ->join('users', 'users.user_id', '=', 'applicant.user_id')
                ->where(DB::raw('CONCAT(users.first_name," ",users.last_name)'), 'like', '%'.$request->searchQuery.'%')
                ->where('applicant.job_id', '=', $request->jobId)
                ->where('applicant.current_step', '=', 'apply')
                ->where('applicant.status', '=', 'waiting')
                ->get();

            foreach ($app as $a){
                $a->link = "applicant";
                $a->returnId = $a->applicant_id;
            }
            return response()->json($app);

        }
        elseif ($request->tableName == "technicalList")
        {

            $technicalTest = DB::table('technical_test')
                ->join('applicant', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('job', 'applicant.job_id', '=', 'job.job_id')
                ->join('department', 'job.department_id', '=', 'department.department_id')
                ->select('technical_test.technical_test_id', 'applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
                ->where('applicant.job_id', '=', $request->jobId)
                ->where('technical_test.status', '=', 'not_tested')
                ->where(DB::raw('CONCAT(users.first_name," ",users.last_name)'), 'like', '%'.$request->searchQuery.'%')
                ->get();

            foreach ($technicalTest as $tech){
                $tech->link = "technical-test";
                $tech->returnId = $tech->technical_test_id;
            }

            return response()->json($technicalTest);

        }
        elseif($request->tableName == "interviewList")
        {
            $interviews = DB::table('interview')
                ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('job', 'applicant.job_id', '=', 'job.job_id')
                ->join('department', 'job.department_id', '=', 'department.department_id')
                ->select('interview.interview_id', 'applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
                ->where('applicant.job_id', '=', $request->jobId)
                ->where('interview.status', '=', 'scheduled')
                ->where(DB::raw('CONCAT(users.first_name," ",users.last_name)'), 'like', '%'.$request->searchQuery.'%')
                ->get();
            foreach ($interviews as $intv){

                $intv->link = "interview";
                $intv->returnId = $intv->interview_id;
            }

            return response()->json($interviews);

        }
        else
        {
            $finals = DB::table('interview')
                ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('job', 'applicant.job_id', '=', 'job.job_id')
                ->join('department', 'job.department_id', '=', 'department.department_id')
                ->select('interview.interview_id', 'applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
                ->where('applicant.job_id', '=', $request->jobId)
                ->where('interview.status', '=', 'completed')
                ->where(DB::raw('CONCAT(users.first_name," ",users.last_name)'), 'like', '%'.$request->searchQuery.'%')
                ->get();
            foreach ($finals as $fin){

                $fin->link = "interview";
                $fin->returnId = $fin->interview_id;
            }
            return response()->json($finals);

        }
    }
}
