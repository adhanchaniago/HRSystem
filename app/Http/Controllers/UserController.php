<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Document;
use App\DocumentType;
use App\Interview;
use App\Job;
use App\JobSkill;
use App\Message;
use App\Task;
use App\UserEducation;
use App\UserExperience;
use App\UserSkill;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function ShowHome()
    {
        $job = DB::table('job')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('job.job_id', 'job.department_id', 'department.department_name', 'job.job_name',
                'job.description', 'job.active_date', 'job.expired_date')
            ->where('job.status', '=', 'open')
            ->where('job.active_date', '<=', now())
            ->where('job.expired_date', '>', now())
            ->get();

        $jobSkill = JobSkill::all();
        return view('welcome')->with([
            "jobs" => $job,
            "jobSkills" => $jobSkill
        ]);
    }

    public function userSignIn(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/dashboard')->with(['success'=>'Welcome, '.Auth::user()->first_name]);
        }
        return redirect('/login')->with('loginError', 'Username or Password is Incorrect.');
    }

    public function userRegister(Request $request){

        $rules = [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
            'agree' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect('/register')->withErrors($validator)->withInput();
        }

        $user = new User();

        $user->user_id = GenerateId('users', 'USR');
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = 'ROLE002';
        //$user->join_date = date("Y-m-d");
        $user->save();

        return redirect('/login')->with('success', 'Register Success! Login now to see yout account.');
    }

    public function UserLogout(Request $request){
        Auth::logout(); /*User logout*/
        $request->session()->flush();
        return redirect('/login');
    }

    public function ShowDashboard(){

        $members = User::all()->where('role_id', '=', 'ROLE002')->count();
        $applicants = Applicant::all()->count();
        $accepted = DB::table('applicant')->where('status', '=', 'accepted')->count();
        $rejected = DB::table('applicant')->where('status', '=', 'rejected')->count();

        $task = DB::table('task')->where('user_id', '=', Auth::user()->user_id)
            ->where('task_date', '>', now())
            ->orderBy('task_date', 'asc')
            ->limit(5)->get();

        $referals = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applied_date', 'applicant.status', 'applicant.current_step','users.first_name', 'users.last_name', 'job.job_name', 'department.department_name')
            ->where('recruiter_id', '=', Auth::user()->user_id)
            ->get();

        $newJob = DB::table('job')
            //->where('expired_date', '>', now())
            ->join('department', 'job.department_id','=','department.department_id')
            ->select('job.*', 'department.department_name')
            ->where('job.status', '=', 'open')
            ->where('job.active_date', '<=', now('Asia/Jakarta'))
            ->where('job.expired_date', '>=', now('Asia/Jakarta'))
            ->orderBy('job.created_at', 'desc')
            ->limit(4)
            ->get();

        $applicant = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applied_date', 'applicant.status', 'applicant.current_step', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.user_id', '=', Auth::user()->user_id)
            ->get();

        $inbox = DB::table('message')
            ->join('users', 'message.from', '=', 'users.user_id')
            ->where('to', 'like', '%'.Auth::user()->email.'%')
            ->select('users.first_name', 'users.last_name', 'users.photo_url', 'message.*')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('hr.dashboard')->with([
            "referals" => $referals,
            "jobs" => $newJob,
            "applications" => $applicant,
            "members" => $members,
            "applicants" => $applicants,
            "accepted" => $accepted,
            "rejected" => $rejected,
            "tasks" => $task,
            "inbox" => $inbox
        ]);
    }

    public function ShowProfile(){
        $id = Auth::user()->user_id;
        $documents = Document::all()->where('regarding_id', '=', $id);
        $experience = UserExperience::all()->where('user_id', '=', $id);
        $education = UserEducation::all()->where('user_id', '=', $id);
        $skill = UserSkill::all()->where('user_id', '=', $id);
        $docType = DocumentType::all();

        if (Auth::user()->role_id == 'ROLE001'){
            $interview = DB::table('interview')
                ->join('interview_type', 'interview.interview_type_id', '=', 'interview_type.interview_type_id')
                ->join('applicant', 'applicant.applicant_id', '=', 'interview.applicant_id')
                ->join('job', 'job.job_id', '=', 'applicant.job_id')
                ->join('department', 'department.department_id', '=', 'job.department_id')
                ->join('users', 'users.user_id', '=', 'applicant.user_id')
                ->select('users.user_id', 'users.first_name', 'users.last_name', 'users.first_name', 'job.job_name', 'department.department_name', 'interview_type.interview_type_name', 'interview.*')
                ->where('interviewer_id', '=', Auth::user()->user_id)
                ->where('interview.status', '=', 'completed')
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
                ->where('interview.status', '=', 'completed')
                ->orderBy('interview.interview_date', 'asc')
                ->orderBy('interview.interview_time', 'asc')
                ->get();
        }

        return view('hr.profile')->with([
            'documents' => $documents,
            'experiences' => $experience,
            'educations' => $education,
            'skills' => $skill,
            'docType' => $docType,
            'interview' => $interview
        ]);
    }



    public function ShowCareer(){

        $jobs = Job::all();

        return view('career')->with([
            'jobs' => $jobs
        ]);
    }

    public function UpdatePersonalInfo(Request $request){

        $rules = [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect('/profile')->withErrors($validator)->withInput();
        }


        $user = Auth::user();

        if(isset($request->university)) {
            $user->university = $request->university;
        }
        if(isset($request->major)) {
            $user->major = $request->major;
        }
        if(isset($request->degree)) {
            $user->degree = $request->degree;
        }

        if(isset($request->new_password)) {
            $user->first_name = $request->first_name;
        }
        if(isset($request->last_name)) {
            $user->last_name = $request->last_name;
        }
        if(isset($request->email)) {
            $user->email = $request->email;
        }
        if(isset($request->phone)) {
            $user->phone = $request->phone;
        }
        if(isset($request->gender)) {
            $user->gender = $request->gender;
        }
        if(isset($request->pob)) {
            $user->birth_place = $request->pob;
        }
        if(isset($request->dob)) {
            $user->birth_date = $request->dob;
        }
        if(isset($request->address)) {
            $user->address = $request->address;
        }
        if(isset($request->new_password)){
            $user->password = $request->new_password;
        }

        if($request->hasFile('photo')){
            $pic = $request->file('photo');
            $namafile = str_replace(' ','_',$request['first_name']).'_'.str_replace(' ','_',$request['last_name']).Auth::user()->user_id.'.'.$pic->getClientOriginalExtension(); /*Membuat nama foto berdasarkan nama pengguna*/
            $pic->move(public_path('/assets/img/users/'), $namafile); /*Memindahkan foto ke direktori assets/images/users*/
            $user->photo_url = '/assets/img/users/'.$namafile;
        }

        $user->save();

        return redirect('/profile');
    }

    public function UpdateCareerInfo(Request $request){

        $this->AddExperience($request);
        $this->AddEducation($request);
        $this->AddSkill($request);

        return redirect('/profile');

    }



    public function AddExperience($request){

        DB::table('user_experience')->where('user_id', '=', Auth::user()->user_id)->delete();

        $experiences = $request->experience;
        $exStarts = $request->exPeriodStart;
        $exEnds = $request->exPeriodEnd;

        $exps = [];
        $lastId = GetLatestID('user_experience');

        foreach ($experiences as $idx=>$ex){
            $lastId++;
            $newId = "UEX".ZeroCondition(strval($lastId));
            array_push($exps, [
                'user_experience_id'=>$newId,
                'user_id'=>Auth::user()->user_id,
               'experience_name'=>$experiences[$idx],
                'period_start' => $exStarts[$idx],
                'period_end' => $exEnds[$idx]
            ]);
        }
        //print_r($exps);
        UserExperience::insert($exps);
    }

    public function AddEducation($request){

        DB::table('user_education')->where('user_id', '=', Auth::user()->user_id)->delete();

        $educations = $request->education;
        $edStarts = $request->edPeriodStart;
        $edEnds = $request->edPeriodEnd;

        $eds = [];
        $lastId = GetLatestID('user_education');

        foreach ($educations as $idx=>$ed){
            $lastId++;
            $newId = "UED".ZeroCondition(strval($lastId));
            array_push($eds, [
                'user_education_id'=>$newId,
                'user_id'=>Auth::user()->user_id,
                'education_name'=>$educations[$idx],
                'period_start' => $edStarts[$idx],
                'period_end' => $edEnds[$idx]
            ]);
        }
        UserEducation::insert($eds);
    }

    public function AddSkill($request){
        DB::table('user_skill')->where('user_id', '=', Auth::user()->user_id)->delete();

        $skills = $request->skill;
        $rates = $request->skillRate;

        $sk = [];
        $lastId = GetLatestID('user_skill');

        foreach ($skills as $idx=>$skill){
            $lastId++;
            $newId = "USK".ZeroCondition(strval($lastId));
            array_push($sk, [
                'user_skill_id'=>$newId,
                'user_id'=>Auth::user()->user_id,
                'skill_name'=>$skills[$idx],
                'rate' => $rates[$idx],
            ]);
        }
        UserSkill::insert($sk);
    }

    public function AddTask(Request $request){
        $task = new Task();
        $task->task_id = GenerateId('task', 'TSK');
        $task->user_id = Auth::user()->user_id;
        $task->task_description = $request->task_desc;
        $task->task_date = $request->task_date;
        $task->save();

        return redirect()->back()->with([
            "success" => "Success Add New Task"
        ]);
    }



    public function ShowAllMember(){
        $members = User::all()->where('role_id', '=', 'ROLE002');

        return view('hr.member_list')->with([
            "members" => $members
        ]);
    }

    public function ShowMemberDetails($id){

        $member = User::find($id);

        $exp = UserExperience::all()->where('user_id', '=', $id);
        $skill = UserSkill::all()->where('user_id', '=', $id);
        $edu = UserEducation::all()->where('user_id', '=', $id);

        return view('hr.member_details')->with([
            "member" => $member,
            "experiences" => $exp,
            "educations" => $edu,
            "skills" => $skill
        ]);
    }

    public function CompareMember(Request $request){

        $member = User::all()->whereIn('user_id', $request->member);
        $education = UserEducation::all()->whereIn('user_id', $request->member);
        $experience = UserExperience::all()->whereIn('user_id', $request->member);
        $skill = UserSkill::all()->whereIn('user_id', $request->member);

        //print_r($member);

        return view('hr.compare_member')->with([
            'members' => $member,
            'experiences' => $experience,
            'educations' => $education,
            'skills' => $skill
        ]);
    }



    public function ShowMailbox(){

        $inbox = DB::table('message')
            ->join('users', 'message.from', '=', 'users.user_id')
            ->where('to', 'like', '%'.Auth::user()->email.'%')
            ->where('status', '!=', 'deleted')
            ->select('users.first_name', 'users.last_name', 'message.*')
            ->orderBy('created_at', 'desc')
            ->get();

        $sent = DB::table('message')
            ->join('users', 'message.from', '=', 'users.user_id')
            ->where('from', '=', Auth::user()->user_id)
            ->where('status', '!=', 'deleted')
            ->select('users.first_name', 'users.last_name', 'message.*')
            ->get();

        $mail_not_read = DB::table('message')
            ->join('users', 'message.from', '=', 'users.user_id')
            ->where([
                ['to', 'like', '%'.Auth::user()->email.'%'],
                ['status', '=', 'not_read']
            ])
            ->where('status', '!=', 'deleted')
            ->select('users.first_name', 'users.last_name', 'users.photo_url', 'message.*')
            ->get();

        return view('mailbox')->with([
            "inboxes" => $inbox,
            "sents" => $sent,
            "mail_not_read" => $mail_not_read
        ]);
    }

    public function DeleteMailbox($id){
        $mail = Message::find($id);
        $mail->status = "deleted";
        $mail->save();

        return redirect()->back()->with(['success'=>'Message Deleted']);
    }

    public function ComposeMessage(Request $request){
        $message = new Message();
        $message->message_id = GenerateId('message', 'MSG');
        $message->from = Auth::user()->user_id;
        $message->to = $request->to;
        $message->subject = $request->subject;
        $message->body = $request->body;
        $message->status = "not_read";
        $message->save();

        return redirect('/mailbox')->with([
           "success" => "Message Sent!"
        ]);
    }

    public function ShowMessageDetails($id){

        $msg = Message::find($id);
        if($msg->status != "read" && $msg->from != Auth::user()->user_id){
            $msg->status = "read";
            $msg->save();
        }

        $message = DB::table('message')
            ->join('users', 'message.from', '=', 'users.user_id')
            ->where('message_id', '=', $id)
            ->select('users.first_name', 'users.last_name', 'users.photo_url','message.*')
            ->first();

        return view('mailbox_message')->with([
            "message" => $message
        ]);
    }

}
