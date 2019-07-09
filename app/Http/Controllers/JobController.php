<?php

namespace App\Http\Controllers;

use App\AppProgress;
use App\Applicant;
use App\Document;
use App\JobSkill;
use App\TechnicalTest;
use App\UserEducation;
use App\UserExperience;
use App\UserSkill;
use function foo\func;
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
    public function AddNewJob(Request $request)
    {

        $rules = [
            'job_department' => 'required',
            'job_name' => 'required|max:50',
            'job_desc' => 'required|max:200',
            'salary' => 'required|max:200',
            'active_date' => 'required',
            'expired_date' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/job/active')->withErrors($validator)->withInput();
        }

        $job_id = GenerateId('job', 'JOB');
        $job = new Job();
        $job->job_id = $job_id;
        $job->department_id = $request->job_department;
        $job->job_name = $request->job_name;
        $job->minimum_age = $request->min_age;
        $job->minimum_experience = $request->min_exp;
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
        $appProgress->progress_name = "Initial Test";
        $appProgress->sequence = 1;
        $appProgress->save();

        return redirect('/job/active')->with('success', 'Job Successfully Posted!');
    }

    public function AddSkill($id, $request)
    {
        DB::table('job_skill')->where('job_id', '=', $id)->delete();

        $skills = $request->skill;
        $rates = $request->skillRate;

        $sk = [];
        $lastId = GetLatestID('job_skill');

        foreach ($skills as $idx => $skill) {
            $lastId++;
            $newId = "JSK" . ZeroCondition(strval($lastId));
            array_push($sk, [
                'job_skill_id' => $newId,
                'job_id' => $id,
                'skill_name' => $skills[$idx],
                'rate' => $rates[$idx],
            ]);
        }
        JobSkill::insert($sk);
    }

    public function ShowActiveJob()
    {
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.active_date', 'job.expired_date')
            ->where('job.status', '=', 'open')
            ->where('job.active_date', '<=', now())
            ->where('job.expired_date', '>', now())
            ->get();
        $dept = Department::all();

        return view('hr.job_active', [
            'active_jobs' => $job,
            'department' => $dept
        ]);
    }

    public function ShowInactiveJob()
    {
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.active_date', 'job.expired_date')
            ->where('job.status', '=', 'closed')
            ->orWhere('job.expired_date', '<', now())
            ->get();
        return view('hr.job_inactive', [
            'inactive_jobs' => $job,
        ]);
    }

    public function JobDetail($id)
    {
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.*', 'department.department_name')
            ->where('job.job_id', '=', $id)
            ->first();

        $department = Department::all();

        $skills = JobSkill::all()->where('job_id', '=', $id);

        $progress = DB::table('application_progress')
            //->select('*')
            ->leftJoin('document', 'application_progress.application_progress_id', 'document.regarding_id')
            ->where('job_id', '=', $id)
            ->select('application_progress.*', 'document.document_url')
            ->orderBy('application_progress_id', 'asc')
            ->get();

        return view('hr.job_details')->with(
            [
                'job' => $job,
                'skills' => $skills,
                'progress' => $progress,
                'department' => $department,
            ]
        );
    }

    public function UpdateJob(Request $request, $id){
        $job = Job::find($id);

        $job->department_id = $request->job_department;
        $job->job_name = $request->job_name;
        $job->description = $request->job_desc;
        $job->salary = $request->salary;
        $job->minimum_age = $request->min_age;
        $job->minimum_experience = $request->min_exp;
        $job->active_date = $request->active_date;
        $job->expired_date = $request->expired_date;

        $this->AddSkill($id, $request);

        $job->save();

        return redirect('/job/details/'.$id)->with(['success', 'Update Job Success!']);
    }

    public function DeactiveJob($id)
    {
        $job = Job::find($id);
        $job->status = 'closed';
        $job->save();
        return redirect('/job/active')->with('success', 'Deactivate Job ' . $job->job_name . " Success");
    }

    public function ReactiveJob(Request $request, $id)
    {
        $job = Job::find($id);
        $job->status = 'open';

        $job->active_date = $request->active_date;
        $job->expired_date = $request->expired_date;
        $job->save();
        return redirect('/job/inactive')->with('success', 'Reactivate Job ' . $job->job_name . " Success");
    }

    public function DeleteJob($id)
    {
        $job = Job::find($id);
        $job->delete();
        return redirect('/job/inactive')->with('success', 'Job ' . $job->job_name . " Has Been Deleted");
    }

    public function ShowAllJob()
    {
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.salary', 'job.active_date', 'job.expired_date')
            ->where('job.status', '=', 'open')
            ->where('job.active_date', '<=', now('Asia/Jakarta'))
            ->where('job.expired_date', '>=', now('Asia/Jakarta'))
            ->get();
        $dept = Department::all();
        $recruiter = User::all()->where('role_id', '=', 'ROLE001');

        $user_id = Auth::user()->user_id;
        $exp = UserExperience::all()->where('user_id', '=', $user_id)->count();
        $edu = UserEducation::all()->where('user_id', '=', $user_id)->count();
        $skl = UserSkill::all()->where('user_id', '=', $user_id)->count();
        $cv = DB::table('document')->where([
            ['regarding_id', '=', $user_id],
            ['document_type_id', '=', 'DTY0001']
        ])->count();

        $validate_profile = false;

        if ($exp > 0 && $edu > 0 && $skl > 0 && $cv > 0) {
            $validate_profile = true;
        } else {
            $validate_profile = false;
        }

        //print($exp.' '.$edu.' '.$skl.' => '.$validate_profile);

        return view('applicant.jobs', [
            'jobs' => $job,
            'department' => $dept,
            'recruiter' => $recruiter,
            'validate_profile' => $validate_profile,
        ]);
    }

    public function ShowApplicantByJob()
    {
        $job = Job::all();

        $tempApplicant = array();

        $totalScore = 0;
        foreach ($job as $jb) {
            $jobSkills = JobSkill::all()->where('job_id', '=', $jb->job_id);
            $applicant = DB::table('applicant')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('user_skill', 'applicant.user_id', '=', 'user_skill.user_id')
                ->select('users.*', 'user_skill.skill_name', 'user_skill.rate', 'applicant.applicant_id', 'applicant.job_id', 'applicant.recruiter_id', 'applicant.applied_date', 'applicant.current_step')
                ->where('applicant.job_id', '=', $jb->job_id)
                ->whereNotIn('applicant.status', ['accepted', 'rejected'] )
                //->limit(5)
                ->get();

            foreach ($applicant as $app) {
                $skillName = $app->skill_name;
                $skillRate = $app->rate;

                $score = 100;
                $totalScore = 0;
                //$otherSkillScore = 0;
                $jobRate = 0;
                foreach ($jobSkills as $jbs) {
                    if ($jbs->skill_name == $skillName) {
                        //$totalScore += $skillRate*
                        $jobRate += $jbs->rate;
                        //break;
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
        }


        $new_arr = [];
        $new_arr = $this->SumScoreByApplicantId($tempApplicant);

        //Sorting output descending berdasarkan score
        usort($new_arr, function ($a, $b) {
            return  $b->score - $a->score;
        });

        return view('hr.applicant_screening')->with([
            'jobs' => $job,
            'applicants' => $new_arr
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

    public function AddApplicationProgress(Request $request, $id){

        $sequenceCheck = true;
        $progress = DB::table('application_progress')->where([
            ['job_id', '=', $id],
            ['sequence', '=', $request->sequence]
        ])->get();

        if(count($progress)>0){
            return redirect('/job/details/'.$id)->with([
                'error' => 'Sequence '.$request->sequence.' already taken by another progress.'
            ]);
        }

        $app = new AppProgress();
        $app->application_progress_id = GenerateId('application_progress', 'APR');
        $app->job_id = $id;
        $app->progress_name = $request->progress_name;
        $app->sequence = $request->sequence;
        $app->save();

        if($request->hasFile('attachment')){

            $doc = new Document();
            $doc->document_id = GenerateId('document', 'DOC');
            $doc->regarding_id = $app->application_progress_id;

            $attach = $request->file('attachment');
            $namafile = $app->application_progress_id.'_'.str_replace(' ','_',$request->progress_name).'.'.$attach->getClientOriginalExtension(); /*Membuat nama foto berdasarkan nama pengguna*/
            $attach->move(public_path('/documents/test_attachment/'), $namafile); /*Memindahkan foto ke direktori assets/images/users*/

            $doc->document_name = $namafile;
            $doc->document_url = '/documents/test_attachment/'.$namafile;
            $doc->document_type_id = "DTY0004";
            $doc->save();
        }

        return redirect('/job/details/'.$id)->with([
            'success' => 'Add Progress Success!'
        ]);
    }

    public function UploadProgressDocument(Request $request, $id){

        $prog = AppProgress::find($id);

        if($request->hasFile('attachment')){

            $doc = new Document();
            $doc->document_id = GenerateId('document', 'DOC');
            $doc->regarding_id = $id;

            $attach = $request->file('attachment');
            $namafile = $id.'_'.str_replace(' ','_',$prog->progress_name).'.'.$attach->getClientOriginalExtension(); /*Membuat nama foto berdasarkan nama pengguna*/
            $attach->move(public_path('/documents/test_attachment/'), $namafile); /*Memindahkan foto ke direktori assets/images/users*/

            $doc->document_name = $namafile;
            $doc->document_url = '/documents/test_attachment/'.$namafile;
            $doc->document_type_id = "DTY0004";
            $doc->save();
        }

        return redirect('/job/details/'.$prog->job_id)->with([
            'success' => 'Add Progress Success!'
        ]);
    }

    public function DeleteProgress($id){

        $doc = Document::all()->where('regarding_id', '=', $id)->first();
        unlink(substr($doc->document_url, 1));
        $doc->delete();

        $app = AppProgress::find($id);
        $job_id = $app->job_id;
        $app->delete();

        return redirect('/job/details/'.$job_id)->with([
            'success' => 'Delete Progress Success!'
        ]);

    }

    public function ShowTechnicalTest(){

        if (Auth::user()->role_id == 'ROLE001') {

            $technical = DB::table('technical_test')
                ->join('applicant', 'technical_test.applicant_id', '=', 'applicant.applicant_id')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('job', 'applicant.job_id', '=', 'job.job_id')
                ->select('users.first_name', 'users.last_name', 'job.job_name', 'applicant.applied_date', 'technical_test.*')
                ->where('technical_test.status', '=', 'not_tested')
                ->get();

        }else{

            $technical = DB::table('technical_test')
                ->join('applicant', 'technical_test.applicant_id', '=', 'applicant.applicant_id')
                ->join('users', 'applicant.user_id', '=', 'users.user_id')
                ->join('job', 'applicant.job_id', '=', 'job.job_id')
                ->select('users.first_name', 'users.last_name', 'job.job_name', 'applicant.applied_date', 'technical_test.*')
                ->where('technical_test.status', '=', 'not_tested')
                ->where('applicant.user_id', '=', Auth::user()->user_id)
                ->get();
        }

        return view('hr.technical_test')->with([
            "technical" => $technical
        ]);
    }

    public function ShowAppliedJobs(){
        $applicant = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.*', 'users.first_name', 'users.last_name', 'job.job_name', 'department.department_name')
            ->where('applicant.user_id', '=', Auth::user()->user_id)
            ->orderBy('applicant.applied_date', 'asc')
            ->get();

        return view('applicant.applied_jobs')->with([
            "applicant" => $applicant
        ]);
    }

    public function AppliedJobDetails($id){

        $applicants = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->leftJoin('technical_test', 'applicant.applicant_id', '=', 'technical_test.applicant_id')
            ->leftJoin('interview', 'applicant.applicant_id', '=', 'interview.applicant_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applicant_id', 'applicant.applied_date', 'applicant.current_step', 'applicant.status', 'users.*',
                'job.job_name', 'job.job_id', 'department.department_name', 'technical_test.technical_test_id', 'interview.interview_id', 'interview.interview_date', 'interview.interview_time', 'interview.interview_venue')
            ->where('applicant.applicant_id', '=', $id)
            ->first();

        $testAns = Document::all()->where('regarding_id', '=', $id);

        $progress = DB::table('application_progress')
            ->where([
                ['job_id', '=', $applicants->job_id]
            ])
            ->leftJoin('document', 'application_progress.application_progress_id', '=', 'document.regarding_id')
            ->select('application_progress.progress_name', 'application_progress.application_progress_id', 'document.*')
            ->orderBy('sequence', 'asc')
            ->get();

        return view('applicant.applied_job_details')
            ->with([
                "applicants" => $applicants,
                "testAnswer" => $testAns,
                "progress" => $progress
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
