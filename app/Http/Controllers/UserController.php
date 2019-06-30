<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Document;
use App\DocumentType;
use App\Job;
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
    public function userSignIn(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/dashboard');
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

    public function ShowDashboard(){

        $referals = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applied_date', 'applicant.status', 'users.first_name', 'users.last_name', 'job.job_name', 'department.department_name')
            ->where('recruiter_id', '=', Auth::user()->user_id)
            ->get();

        $newJob = DB::table('job')
            //->where('expired_date', '>', now())
                ->join('department', 'job.department_id','=','department.department_id')
            ->select('job.*', 'department.department_name')
            ->where('job.status', '=', 'open')
            ->orderBy('job.created_at', 'desc')
            ->limit(4)
            ->get();

        $applicant = DB::table('applicant')
            ->join('users', 'applicant.user_id', '=', 'users.user_id')
            ->join('job', 'applicant.job_id', '=', 'job.job_id')
            ->join('department', 'job.department_id', '=', 'department.department_id')
            ->select('applicant.applied_date', 'applicant.status', 'users.*','job.job_name', 'department.department_name')
            ->where('applicant.user_id', '=', Auth::user()->user_id)
            ->get();

        return view('hr.dashboard')->with([
            "referals" => $referals,
            "jobs" => $newJob,
            "applications" => $applicant
            ]);
    }

    public function ShowAllMember(){
        $members = User::all()->where('role_id', '=', 'ROLE002');

        return view('hr.member_list')->with([
            "members" => $members
        ]);
    }

    public function ShowProfile(){
        $id = Auth::user()->user_id;
        $documents = Document::all()->where('user_id', '=', $id);
        $experience = UserExperience::all()->where('user_id', '=', $id);
        $education = UserEducation::all()->where('user_id', '=', $id);
        $skill = UserSkill::all()->where('user_id', '=', $id);
        $docType = DocumentType::all();

        return view('hr.profile')->with([
            'documents' => $documents,
            'experiences' => $experience,
            'educations' => $education,
            'skills' => $skill,
            'docType' => $docType
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

}
