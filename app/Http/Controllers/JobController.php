<?php

namespace App\Http\Controllers;

use App\AppProgress;
use App\Applicant;
use App\JobSkill;
use App\TechnicalTest;
use App\UserEducation;
use App\UserExperience;
use App\UserSkill;
use Illuminate\Http\Request;
use App\User;
use App\Job;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //
    public function AddNewJob(Request $request){

        $rules = [
            'job_department' => 'required',
            'job_name' => 'required|max:50',
            'job_desc' => 'required|max:200',
            'salary' => 'required|max:200',
            'active_date' => 'required',
            'expired_date' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect('/job/active')->withErrors($validator)->withInput();
        }

        $job_id = GenerateId('job', 'JOB');
        $job = new Job();
        $job->job_id = $job_id;
        $job->department_id = $request->job_department;
        $job->job_name = $request->job_name;
        $job->description = $request->job_desc;
        $job->salary = $request->salary;
        $job->active_date = $request->active_date;
        $job->expired_date = $request->expired_date;
        $job->status = "open";

        $job->save();

        $this->AddSkill($job->job_id, $request);

        $appProgress = new AppProgress();
        $appProgress->application_progress_id = GenerateId('application_progress', 'APR');
        $appProgress->job_id = $job_id;
        $appProgress->progress_name = "Writting Test";
        $appProgress->sequence = 1;
        $appProgress->save();

        return redirect('/job/active')->with('success','Job Successfully Posted!');
    }

    public function AddSkill($id, $request){
        DB::table('job_skill')->where('job_id', '=', $id)->delete();

        $skills = $request->skill;
        $rates = $request->skillRate;

        $sk = [];
        $lastId = GetLatestID('job_skill');

        foreach ($skills as $idx=>$skill){
            $lastId++;
            $newId = "JSK".ZeroCondition(strval($lastId));
            array_push($sk, [
                'job_skill_id'=>$newId,
                'job_id'=>$id,
                'skill_name'=>$skills[$idx],
                'rate' => $rates[$idx],
            ]);
        }
        JobSkill::insert($sk);
    }

    public function ShowActiveJob(){
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.active_date', 'job.expired_date')
            ->where('job.status', '=', 'open')
            ->where('job.active_date','<=', now())
            ->where('job.expired_date', '>', now())
            ->get();
        $dept = Department::all();

        return view('hr.job_active',[
            'active_jobs' => $job,
            'department' => $dept
        ]);
    }

    public function ShowInactiveJob(){
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.active_date', 'job.expired_date')
            ->where('job.status', '=', 'closed')
            ->orWhere('job.expired_date', '<', now())
            ->get();
        return view('hr.job_inactive',[
            'inactive_jobs' => $job,
        ]);
    }

    public function JobDetail($id){
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.active_date', 'job.expired_date', 'job.salary')
            ->where('job.job_id', '=', $id)
            ->first();

        $skills = JobSkill::all()->where('job_id', '=', $id);

        $applicant = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applied_date', 'applicant.status', 'applicant.current_step', 'users.first_name', 'users.last_name', 'job.job_name', 'department.department_name')
            ->where('applicant.job_id', '=', $id)
            ->get();

        $progress = DB::table('application_progress')
            //->select('*')
            ->where('job_id', '=', $id)
            ->orderBy('sequence', 'asc')
            ->get();

        return view('hr.job_details')->with(
            [
                'job' => $job,
                'skills' => $skills,
                'applicant' => $applicant,
                'progress' => $progress
            ]
        );
    }

    public function DeactiveJob($id){
        $job = Job::find($id);
        $job->status = 'closed';
        $job->save();
        return redirect('/job/active')->with('success','Deactivate Job '.$job->job_name." Success");
    }

    public function ReactiveJob(Request $request, $id){
        $job = Job::find($id);
        $job->status = 'open';

        $job->active_date = $request->active_date;
        $job->expired_date = $request->expired_date;
        $job->save();
        return redirect('/job/inactive')->with('success','Reactivate Job '.$job->job_name." Success");
    }

    public function DeleteJob($id){
        $job = Job::find($id);
        $job->delete();
        return redirect('/job/inactive')->with('success','Job '.$job->job_name." Has Been Deleted");
    }

    public function ShowAllJob(){
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.salary', 'job.active_date', 'job.expired_date')
            ->where('job.status', '=', 'open')
            ->where('job.active_date','<=', now())
            ->where('job.expired_date', '>=', now())
            ->get();
        $dept = Department::all();
        $recruiter = User::all()->where('role_id', '=', 'ROLE001');

        $user_id = Auth::user()->user_id;
        $exp = UserExperience::all()->where('user_id', '=', $user_id)->count();
        $edu = UserEducation::all()->where('user_id', '=', $user_id)->count();
        $skl = UserSkill::all()->where('user_id', '=', $user_id)->count();

        $validate_profile = false;

        if($exp > 0 && $edu > 0  && $skl > 0 ){
            $validate_profile = true;
        }else{
            $validate_profile = false;
        }

        //print($exp.' '.$edu.' '.$skl.' => '.$validate_profile);

        return view('applicant.jobs',[
            'jobs' => $job,
            'department' => $dept,
            'recruiter' => $recruiter,
            'validate_profile' => $validate_profile,
        ]);
    }

    public function ShowApplicantByJob(){

        $job = DB::table('job')->where('status', '=', 'open')
            ->where('job.active_date','<=', now())
            ->where('job.expired_date', '>=', now())
            ->get();

//        $applicant = DB::table('applicant')
//            ->join('users','applicant.user_id', '=', 'users.user_id')
//            ->select('users.*', 'applicant.applicant_id', 'applicant.job_id', 'applicant.recruiter_id', 'applicant.applied_date', 'applicant.current_step')
//            ->get();

//        $jobSkill = array();
//        $userSkill = array();

        $tempApplicant = array();
        foreach ($job as $jb){
            $jobSkills = JobSkill::all()->where('job_id', '=', $jb->job_id);
            $applicant = DB::table('applicant')
                ->join('users','applicant.user_id', '=', 'users.user_id')
                ->join('user_skill', 'applicant.user_id', '=', 'user_skill.user_id')
                ->select('users.*', 'user_skill.skill_name', 'user_skill.rate', 'applicant.applicant_id', 'applicant.job_id', 'applicant.recruiter_id', 'applicant.applied_date', 'applicant.current_step')
                ->where('job_id', '=', $jb->job_id)
                ->where('applicant.status', '=', 'waiting')
                ->limit(5)
                ->get();

            foreach ($applicant as $app){
                $skillName = $app->skill_name;
                $skillRate = $app->rate;

                $score = 100;
                $totalScore = 0;
                $otherSkillScore = 0;
                $jobRate = 0;
                foreach ($jobSkills as $jbs){
                    if($jbs->skill_name == $skillName){
                        //$totalScore += $skillRate*
                        $jobRate += $jbs->rate;
                        //break;
                    }
                    $score -= $jbs->rate;
                }

                if($jobRate > 0){
                    $totalScore += $skillRate * $jobRate;
                }else{
                    if($score > 0){
                        $totalScore += $skillRate * $score;
                    }else {
                        $totalScore += $skillRate * 1;
                    }
                }
                $app->score = $totalScore;

                if(count($tempApplicant) > 0){
                    foreach ($tempApplicant as $temp){
                        if($temp->user_id == $app->user_id && $temp->job_id && $app->job_id){
                            $temp->score += $totalScore;
                            //$temp->save();
                        }else{
                            $app->score = $totalScore;
                            array_push($tempApplicant, $app);
                        }
                    }
                }else{
                    $app->score = $totalScore;
                    array_push($tempApplicant, $app);
                }
            }
        }

        //Sorting output descending berdasarkan score
        usort($tempApplicant, function ($a, $b) {
            return  $b->score - $a->score;
        });

        return view('hr.applicant_screening')->with([
            'jobs' => $job,
            'applicants' => $tempApplicant
        ]);
    }

    public function AddApplicationProgress(Request $request, $id){
        $app = new AppProgress();
        $app->application_progress_id = GenerateId('application_progress', 'APR');
        $app->job_id = $id;
        $app->progress_name = $request->progress_name;
        $app->sequence = $request->sequence;
        $app->save();

        return redirect('/job/details/'.$id)->with([
            'success' => 'Add Progress Success!'
        ]);
    }

    public function ShowAppliedJobs(){
        $applicant = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applied_date', 'applicant.status', 'applicant.current_step', 'users.first_name', 'users.last_name', 'job.job_name', 'department.department_name')
            ->where('applicant.user_id', '=', Auth::user()->user_id)
            ->get();

        return view('applicant.applied-jobs')->with([
            "applicant" => $applicant
        ]);
    }

    public function ShowAllDepartment(){
        $dept = Department::all();

        return view('hr.department')->with(
            ['dept' => $dept]
        );
    }

    public function AddDepartment(Request $request){

        $dpt = new Department();
        $dpt->department_id = GenerateId('department', 'DPT');
        $dpt->department_name = $request->department_name;
        $dpt->save();

        return redirect('/department');
    }

    public function UpdateDepartment(Request $request, $id){
        $dpt = Department::find($id);
        $dpt->department_name = $request->department_name;
        $dpt->save();

        return redirect('/department')->with('success', 'Department Updated.');
    }

    public function DeleteDepartment($id){
        $dpt = Department::find($id);
        $dpt->delete();
        return redirect('/department')->with('success','Department Deleted.');
    }
}
