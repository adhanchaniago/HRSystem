<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\AppProgress;
use App\Document;
use App\Interview;
use App\InterviewType;
use App\JobSkill;
use App\Message;
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

    //Applicant Functions
    public function ProceedApplicant($id){
        $applicant = Applicant::find($id);
        $applicant->current_step = 'technical_test';
        $applicant->status = 'waiting';

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
        $applicant->status = 'rejected';
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

        $allapplicants = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.job_id', '=', $id)
            ->get();

        $applicants = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.job_id', '=', $id)
            ->where('applicant.status', '=', 'waiting')
            ->where('applicant.current_step', '=', 'apply')
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

        $finals = DB::table('interview')
            ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('interview.interview_id', 'applicant.applicant_id', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.job_id', '=', $id)
            ->where('interview.status', '=', 'completed')
            ->get();

        $job = Job::find($id);

        return view('hr.applicant_list')->with([
            "allapplicants" => $allapplicants,
            "applicants" => $applicants,
            "job_detail" => $job,
            "technical_test" => $technicalTest,
            "interviews" => $interviews,
            "finals" => $finals,
        ]);
    }

    public function ApplyJob(Request $request){
        $applicant = new applicant();

        $applicant->applicant_id = GenerateId('applicant', 'APL');
        $applicant->job_id = $request->job_id;
        $applicant->user_id = Auth::user()->user_id;
        $applicant->applied_date = date('Y-m-d');
        $applicant->current_step = "apply";
        $applicant->status = "waiting";

        if($request->has('recruiter_id')){
            $applicant->recruiter_id = $request->recruiter_id;
        }

        $applicant->save();
        //print_r($applicant);

        return redirect('/job/applied-jobs');
    }

    public function CompareApplicant(Request $request, $id){


        //CHANGE THIS TO SIMPLE ADDITIVE WEIGHTING


        $interviewer = User::all()->where('role_id', '=', 'ROLE001');
        $intvMethod = InterviewType::all();

        $jobSkills = JobSkill::all()->where('job_id', '=', $id);

        $applicant = DB::table('applicant')
            ->join('users', 'users.user_id', '=', 'applicant.user_id')
            ->join('user_skill', 'applicant.user_id', '=', 'user_skill.user_id')
            ->leftJoin('technical_test', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
            ->leftJoin('interview', 'applicant.applicant_id', '=', 'interview.applicant_id')
            ->whereIn('applicant.applicant_id', $request->compare)
            ->where('job_id', '=', $id)
            ->select('users.*', 'user_skill.skill_name', 'user_skill.rate', 'applicant.applicant_id', 'applicant.current_step', 'technical_test.average_score', 'technical_test.technical_test_id', 'interview.interview_score', 'interview.status as interview_status', 'interview.interview_id')
            ->get();

        $job = Job::find($id);

        $totalSkill = $jobSkills->count();
        $tempApplicant = array();
        $minJobScore = 0;
        $jrate = 0;
        $minAge = $job->minimum_age;
        $minExp = $job->minimum_experience;

        foreach ($applicant as $app) {
            $skillName = $app->skill_name;
            $skillRate = $app->rate;

            $score = 100;
            $totalScore = 0;
            $jobRate = 0;
            foreach ($jobSkills as $jbs) {
                if ($jbs->skill_name == $skillName) {
                    $jobRate += $jbs->rate;
                }
                $score -= $jbs->rate;
            }

            if ($jobRate > 0) {
                $totalScore += $skillRate * $jobRate;
            } else {
                if ($score > 0) {
                    $totalScore += $skillRate * $score;
                } else {
                    $totalScore += $skillRate * 1;
                }
            }
            $app->score = $totalScore;
            array_push($tempApplicant,$app);
        }

        foreach ($jobSkills as $jbs) {
            $jrate = $jbs->rate * $jbs->rate;
            $minJobScore = $minJobScore + $jrate;
        }

        $new_arr = [];
        $new_arr = $this->SumScoreByApplicantId($tempApplicant);

        //Sorting output descending berdasarkan score
        usort($new_arr, function ($a, $b) {
            return  $b->score - $a->score;
        });

        $jsAvg = $minJobScore;
        foreach ($new_arr as $idx => $na){
            $gain = 0;
            $experience = UserExperience::all()->where('user_id', '=', $na->user_id);
            $diff = abs(strtotime(now()) - strtotime($na->birth_date));
            $age = floor($diff / (365*60*60*24));
            $totalExp = 0;
            foreach($experience as $exp){
                $date1 = strtotime($exp->period_start);
                $date2 = strtotime($exp->period_end);

                // Formulate the Difference between two dates
                $diff = abs($date2 - $date1);
                //calculate total years
                $years = floor($diff / (365*60*60*24));
                $totalExp += $years;
            }

            if($na->score > $jsAvg){
                $gain = 3;
            }
            else
            {
                if($totalExp > $minExp){
                    $gain = 2;
                }else{
                    if($age > $minAge){
                        $gain = 1;
                    }
                }
            }

            $na->exp = $totalExp;
            $na->age = $age;
            $na->gain = $gain;
        }

        $job->avg_score = $jsAvg;

        return view('hr.compare_applicant')->with([
            'members' => $new_arr,
            'job' => $job,
            "interviewer" => $interviewer,
            "intvMethod" => $intvMethod
        ]);
    }

    public function SumScoreByApplicantId($data) {
        $groups = array();
        foreach ($data as $item) {
            $key = $item->applicant_id;
            if (!array_key_exists($key, $groups)) {
                $groups[$key] = $item;
            } else {
                $groups[$key]->score = $groups[$key]->score + $item->score;
            }
        }
        return $groups;
    }

    public function ApplicantReportPrint($reportType, $id){


        if($reportType == "technical-test"){
            $techs = DB::table('technical_test')
                ->join('applicant', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('job', 'applicant.job_id', '=', 'job.job_id')
                ->join('department', 'job.department_id', '=', 'department.department_id')
                ->select('technical_test.*', 'applicant.applied_date', 'applicant.status', 'users.*','job.job_id', 'job.job_name', 'department.department_name')
                ->where('technical_test.technical_test_id', '=', $id)
                ->first();

        }else{
            $techs = DB::table('interview')
                ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('technical_test', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
                ->join('job', 'applicant.job_id', '=', 'job.job_id')
                ->join('department', 'job.department_id', '=', 'department.department_id')
                ->select('interview.*', 'technical_test.score_1', 'technical_test.score_2', 'technical_test.score_3', 'technical_test.score_4', 'technical_test.average_score', 'applicant.applied_date', 'applicant.status', 'users.*', 'job.job_id', 'job.job_name', 'department.department_name')
                ->where('interview.interview_id', '=', $id)
                ->first();
        }

        $approg = DB::table('application_progress')->where('job_id', '=', $techs->job_id)->orderBy('sequence', 'asc')->get();

        return view('hr.print_test_report')->with([
            "progress" => $approg,
            "tech" => $techs,
            "reportType" => $reportType
        ]);
    }


    //Technical Test Functions
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
            ->where('document.regarding_id', '=', $techs->applicant_id)
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
        $tech->status = "tested";

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
        $app->status = "rejected";
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
        $app->current_step = 'interview';
        $app->status = "waiting";
        $app->save();

        $interview = new Interview();
        $interview->interview_id = GenerateId('interview', 'ITV');
        $interview->interview_type_id = $request->interview_type;
        $interview->interviewer_id = $request->interviewer;
        $interview->applicant_id = $job->applicant_id;
        $interview->interview_date = $request->interview_date;
        $interview->interview_time = $request->interview_time;

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

    public function UploadTestAnswers(Request $request, $id){

        if($request->hasFile('answerFile')) {

            $document = Document::all()->where('document_name', '=', $request->document_name)->first();
            if($document){
                if($document->document_name = $request->document_name){
                    unlink(substr($document->document_url, 1));
                    $document->delete();
                }
            }

            $doc = new Document();
            $doc->document_id = GenerateId('document', 'DOC');
            $doc->document_name = $request->document_name;
            $doc->regarding_id = $id;
            $doc->document_type_id = "DTY0003";

            $file = $request->file('answerFile');
            $namafile = $request->document_name.'.'.$file->getClientOriginalExtension(); /*Membuat nama foto berdasarkan nama pengguna*/
            $file->move(public_path('/documents/test_answers/'.$id.'/'), $namafile); /*Memindahkan foto ke direktori assets/images/users*/

            $doc->document_url = '/documents/test_answers/'.$id.'/'.$namafile;
            $doc->created_at = now('Asia/Jakarta');
            $doc->updated_at = now('Asia/Jakarta');
            $doc->save();

            return redirect()->back()->with([
                "success" => "Success upload answers!"
            ]);
        }

        return redirect()->back()->with([
            "error" => "No file detected."
        ]);
    }


    //Interview Functions
    public function InterviewDetail($id){

        $interview = DB::table('interview')//
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

        $interviewTime = $interview->interview_time;
        $sessionStart = date('Y-m-d h:i:s', strtotime($interview->interview_date.' '.$interviewTime));
        $sessionExpired = date('Y-m-d h:i:s', strtotime($interview->interview_date.' '.$interviewTime . '+ 30 minutes'));
        $now = date('Y-m-d h:i:s', strtotime(now() . '- 5 hours'));

        $approg = DB::table('application_progress')->where('job_id', '=', $interview->job_id)->orderBy('sequence', 'asc')->get();
//        $experience = UserExperience::all()->where('user_id', '=', $interviews->user_id);
//        $education = UserEducation::all()->where('user_id', '=', $interviews->user_id);
//        $skill = UserSkill::all()->where('user_id', '=', $interviews->user_id);

        $rescheduleMinTime = date('Y-m-d h:i:s', strtotime($interview->interview_date.' '.$interviewTime.' - 30 minutes'));
        return view('hr.interview_detail')->with([
            "interview" => $interview,
            "approg" => $approg,
            'start_date' => $sessionStart,
            'expired_date' => $sessionExpired,
            'rescheduleMinTime' => $rescheduleMinTime,
            'now' => $now
        ]);
    }

    public function ShowAllInterview(){

        if (Auth::user()->role_id == 'ROLE001'){
            $interview = DB::table('interview')
                ->join('interview_type', 'interview.interview_type_id', '=', 'interview_type.interview_type_id')
                ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
                ->join('job', 'job.job_id', '=', 'applicant.job_id')
                ->join('department', 'department.department_id', '=', 'job.department_id')
                ->join('users', 'users.user_id', '=', 'applicant.user_id')
                ->select('users.user_id', 'users.first_name', 'users.last_name', 'users.first_name', 'job.job_name', 'department.department_name', 'interview_type.interview_type_name', 'interview.*')
                ->where('interviewer_id', '=', Auth::user()->user_id)
                ->where('interview.status', '=', 'scheduled')
                ->orderBy('interview.interview_date', 'asc')
                ->orderBy('interview.interview_time', 'asc')
                ->get();
        }else{
            $interview = DB::table('interview')
                ->join('interview_type', 'interview.interview_type_id', '=', 'interview_type.interview_type_id')
                ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
                ->join('job', 'job.job_id', '=', 'applicant.job_id')
                ->join('department', 'department.department_id', '=', 'job.department_id')
                ->join('users', 'users.user_id', '=', 'interview.interviewer_id')
                ->select('users.user_id', 'users.first_name', 'users.last_name', 'users.first_name', 'applicant.user_id', 'job.job_name', 'department.department_name', 'interview_type.interview_type_name', 'interview.*')
                ->where('applicant.user_id', '=', Auth::user()->user_id)
                ->where('interview.status', '=', 'scheduled')
                ->orderBy('interview.interview_time', 'asc')
                ->orderBy('interview.interview_date', 'asc')
                ->get();
        }

        return view('hr.interview_schedule')->with([
            "interviews"=>$interview
        ]);
    }

    public function InterviewCompleted(Request $request, $id){
        $interview = Interview::find($id);
        $interview->status = 'completed';
        $interview->interview_score = $request->interview_score;
        $interview->save();

        $applicant = Applicant::find($interview->applicant_id);
        $applicant->current_step = 'final';
        $applicant->status = 'waiting';
        $applicant->save();

        return redirect('/job/'.$applicant->job_id.'/applicants')->with([
            "success" => "Success set interview as completed."
        ]);
    }

    public function InterviewProceed($id){

        $interview = Interview::find($id);
        $interview->status = 'pass';
        $interview->save();

        $applicant = Applicant::find($interview->applicant_id);
        $applicant->status = 'accepted';
        $applicant->save();

        return redirect('/job/'.$applicant->job_id.'/applicants')->with([
            "success" => "Success accept applicant as new employee."
        ]);
    }

    public function InterviewReject($id){
        $interview = Interview::find($id);
        $interview->status = 'fail';
        $interview->save();

        $applicant = Applicant::find($interview->applicant_id);
        $applicant->status = 'rejected';
        $applicant->save();

        return redirect('/job/'.$applicant->job_id.'/applicants')->with([
            "success" => "Success accept applicant as new employee."
        ]);
    }

    public function InterviewSession($code)
    {
        $interview = Interview::all()
            ->where('interview_code', '=', $code)->first();

        $interviewTime = $interview->interview_time;
        $sessionStart = date('Y-m-d h:i:s', strtotime($interview->interview_date.' '.$interviewTime));
        $sessionExpired = date('Y-m-d h:i:s', strtotime($interview->interview_date.' '.$interviewTime . '+ 30 minutes'));
        $now = date('Y-m-d h:i:s', strtotime(now() . '- 5 hours'));

        if ($interview) {
            if ($now > $sessionStart && $now < $sessionExpired) {
                return view('interview_session')->with([
                    'interview' => $interview,
                    'status' => 'start',
                    'start_date' => $sessionStart,
                    'expired_date' => $sessionExpired,
                    'now' => $now
                ]);
            } elseif ($now < $sessionStart) {
                return view('interview_session')->with([
                    'interview' => $interview,
                    'status' => 'not started',
                    'start_date' => $sessionStart,
                    'expired_date' => $sessionExpired,
                    'now' => $now
                ]);
            } elseif ($now > $sessionExpired) {
                return view('interview_session')->with([
                    'interview' => $interview,
                    'status' => 'expired',
                    'start_date' => $sessionStart,
                    'expired_date' => $sessionExpired,
                    'now' => $now
                ]);
            }
        } else {
            return view('interview_session')->with([
                'status' => 'invalid code'
            ]);
        }
    }

    public function InterviewReschedule(Request $request, $id){
        $interview = Interview::find($id);
        $interview->interview_date = $request->new_date;
        $interview->interview_time = $request->new_time;
        $interview->save();

        $app = DB::table('interview')
            ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->where('interview_id', '=', $id)
            ->select('users.email', 'job.job_name')
            ->first();

        $message = new Message();
        $message->message_id = GenerateId('message', 'MSG');
        $message->from = Auth::user()->user_id;
        $message->to = $app->email;
        $message->subject = "Interview Has Been Rescheduled";
        $message->body = "Your interview schedule for job ".$app->job_name." has been rescheduled to ".date('d M y', strtotime($request->new_date)).", ".$request->new_time.".";
        $message->status = "not_read";
        $message->save();

        return redirect()->back()->with(['success'=>'Reschedule Success']);

    }

    public function InterviewSigner(Request $request){

        $token = $request->token;
        $secret = 'W62wB9JjW3tFyUMtF5QhRSbk';
        $hmac = hash_hmac('sha256', $token, $secret, TRUE);
        $hmac = base64_encode($hmac);

        return $hmac;
    }

    public function InterviewCompleteOnline(Request $request){

        $interviewId = $request->interviewId;
        $intv = Interview::find($interviewId);
        $intv->status = "completed";
        $intv->interview_score = $request->interview_score;
        $intv->save();

        return redirect('/interview/'.$interviewId);
    }



    public function ShowReport(){


        return view ('');
    }
}
