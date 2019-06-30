<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\AppProgress;
use App\Document;
use App\Interview;
use App\InterviewType;
use App\TechnicalTest;
use App\User;
use App\Job;
use App\Department;
use App\UserEducation;
use App\UserExperience;
use App\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class applicantController extends Controller
{
    //
//    public function ShowAllapplicant(){
//        $applicants = DB::table('applicant')
//            ->join('users', 'applicant.user_id', '=', 'users.user_id')
//            ->join('job', 'applicant.job_id', '=', 'job.job_id')
//            ->join('department', 'job.department_id', '=', 'department.department_id')
//            ->select('applicant.applied_date', 'applicant.status', 'users.user_id', 'users.first_name', 'users.last_name', 'users.photo_url','job.job_name', 'department.department_name')
//            ->get();
//
//        return view('hr.applicant_list')->with([
//            "applicants" => $applicants
//        ]);
//    }

    public function ProceedApplicant($id){
        $applicant = Applicant::find($id);
        $applicant->status = 'apply_pass';
        $applicant->save();

        $technicalTest = new TechnicalTest();
        $technicalTest->technical_test_id = GenerateId('technical_test', 'TCT');
        $technicalTest->applicant_id = $id;
        $technicalTest->status = 'not_tested';
        $technicalTest->save();

        return redirect('/job/'.$applicant->job_id.'/applicants')->with([
            "success" => "Proceed Applicant Success."
        ]);
    }

    public function RejectApplicant($id){

        $applicant = Applicant::find($id);
        $applicant->status = 'apply_fail';
        $applicant->save();

        return redirect('/job/'.$applicant->job_id.'/applicants')->with([
            "success" => "Reject Applicant Success."
        ]);
    }

    public function ShowapplicantDetails($id){
        $applicants = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*',
'job.job_name', 'department.department_name')
            ->where('applicant.applicant_id', '=', $id)
            ->first();

        $experience = UserExperience::all()->where('user_id', '=', $applicants->user_id);
        $education = UserEducation::all()->where('user_id', '=', $applicants->user_id);
        $skill = UserSkill::all()->where('user_id', '=', $applicants->user_id);

        return view('hr.applicant_details')->with([
            "applicant" => $applicants,
            "experiences" => $experience,
            "educations" => $education,
            "skills" => $skill
        ]);
    }

    public function ShowJobapplicant($id){

        $applicants = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.job_id', '=', $id)
            ->where('applicant.status', '=', 'waiting')
            ->get();

        $technicalTest = DB::table('technical_test')
            ->join('applicant', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('technical_test.technical_test_id', 'applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.job_id', '=', $id)
            ->where('technical_test.status', '=', 'not_tested')
            ->get();

        $interviews = DB::table('interview')
            ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('interview.interview_id', 'applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.job_id', '=', $id)
            ->where('interview.status', '=', 'scheduled')
            ->get();

        $job = Job::find($id);

        return view('hr.applicant_list')->with([
            "applicants" => $applicants,
            "job_detail" => $job,
            "technical_test" => $technicalTest,
            "interviews" => $interviews,
        ]);
    }

    public function ApplyJob(Request $request){
        $applicant = new applicant();

        $applicant->applicant_id = GenerateId('applicant', 'APL');
        $applicant->job_id = $request->job_id;
        $applicant->user_id = Auth::user()->user_id;
        $applicant->applied_date = date('Y-m-d');
        $applicant->current_step = "1";
        $applicant->status = "waiting";

        if($request->has('recruiter_id')){
            $applicant->recruiter_id = $request->recruiter_id;
        }

        $applicant->save();
        //print_r($applicant);

        return redirect('/job/applied-jobs');
    }

    public function TechnicalTestDetail($id){

        $interviewer = User::all()->where('role_id', '=', 'ROLE001');

        $techs = DB::table('technical_test')
            ->join('applicant', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('technical_test.*', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_id', 'job.job_name', 'department.department_name')
            ->where('technical_test.technical_test_id', '=', $id)
            ->first();

        $approg = DB::table('application_progress')->where('job_id', '=', $techs->job_id)->orderBy('sequence', 'asc')->get();

//        $experience = UserExperience::all()->where('user_id', '=', $techs->user_id);
//        $education = UserEducation::all()->where('user_id', '=', $techs->user_id);
//        $skill = UserSkill::all()->where('user_id', '=', $techs->user_id);

        $document = DB::table('document')
            ->join('document_type', 'document.document_type_id', '=', 'document_type.document_type_id')
            ->select('document.*', 'document_type.document_type_name')
            ->where('document.user_id', '=', $techs->user_id)
            ->where('document.document_type_id', '=', 'DTY0003')
            ->get();

        $intvMethod = InterviewType::all();

        return view ('hr.technical_test_detail')->with([
            "technical" => $techs,
            "approg" => $approg,
            "interviewer" => $interviewer,
            "documents" => $document,
            "intvMethod" => $intvMethod
        ]);
    }

    public function TechnicalTestUpdate(Request $request, $id){

        $tech = TechnicalTest::find($id);
        $seqs = $request->sequence;
        $score = $request->score;
        $average = 0;
        foreach ($seqs as $idx=>$seq){
            $scoreCol = "score_".$seqs[$idx];
            $tech->{$scoreCol} = $score[$idx];
            $tech->save();

            $average += $score[$idx];
        }
        $average = $average/count($score);

        $tech->average_score = $average;

        $tech->save();

        return redirect()->back()->with([
            "success" => "Score Submited"
        ]);
    }

    public function TechnicalTestReject($id){
        $tech = TechnicalTest::find($id);
        $tech->status = "fail";
        $tech->save();

        $job = DB::table('technical_test')
            ->join('applicant', 'technical_test.applicant_id', '=', 'applicant.applicant_id')
            ->select('applicant.job_id', 'applicant.applicant_id')
            ->where('technical_test.technical_test_id', '=', $id)
            ->first();

        $app = Applicant::find($job->applicant_id);
        $app->status = "technical_test_fail";
        $app->save();

        return redirect('/job/'.$job->job_id.'/applicants')->with([
            "success" => "Reject Applicant Success"
        ]);
    }

    public function TechnicalTestProceed(Request $request, $id){

        $tech = TechnicalTest::find($id);
        $tech->status = "pass";
        $tech->save();

        $job = DB::table('technical_test')
            ->join('applicant', 'technical_test.applicant_id', '=', 'applicant.applicant_id')
            ->select('applicant.job_id', 'applicant.applicant_id')
            ->where('technical_test.technical_test_id', '=', $id)
            ->first();

        $app = Applicant::find($job->applicant_id);
        $app->status = "technical_test_pass";
        $app->save();

        $interview = new Interview();
        $interview->interview_id = GenerateId('interview', 'ITV');
        $interview->interview_type_id = $request->interview_type;
        $interview->interviewer_id = $request->interviewer;
        $interview->applicant_id = $job->applicant_id;
        $interview->interview_datetime = $request->interview_datetime;

        if($request->interview_type == "ITY0001"){
            $interview->interview_venue = $request->interview_venue;
        }else{
            $interview->interview_code = GenerateCode();
        }

        $interview->status = "scheduled";

        $interview->save();


        return redirect('/job/'.$job->job_id.'/applicants')->with([
            "success" => "Set Interview Schedule Success"
        ]);
    }

    public function InterviewDetail($id){

        $interviews = DB::table('interview')//
            ->join('interview_type', 'interview_type.interview_type_id', '=', 'interview.interview_type_id')
            ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
            ->join('technical_test', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('users as u', 'interview.interviewer_id', '=', 'u.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('interview.*', 'u.first_name as interviewer_first_name', 'u.last_name as interviewer_last_name', 'interview_type.interview_type_name', 'technical_test.score_1', 'technical_test.score_2', 'technical_test.score_3', 'technical_test.score_4', 'technical_test.average_score', 'applicant.applied_date', 'users.*', 'job.job_id', 'job.job_name', 'department.department_name')
            ->where('interview.interview_id', '=', $id)
            ->first();

        $approg = DB::table('application_progress')->where('job_id', '=', $interviews->job_id)->orderBy('sequence', 'asc')->get();
//        $experience = UserExperience::all()->where('user_id', '=', $interviews->user_id);
//        $education = UserEducation::all()->where('user_id', '=', $interviews->user_id);
//        $skill = UserSkill::all()->where('user_id', '=', $interviews->user_id);

        return view('hr.interview_detail')->with([
            "interview" => $interviews,
            "approg" => $approg,
        ]);
    }


    public function ShowAllInterview(){

        return view('hr.interview_schedule');
    }

}