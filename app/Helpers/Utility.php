<?php
/**
 * Created by PhpStorm.
 * User: Alim Rafli
 * Date: 6/15/2019
 * Time: 07:59
 */
use Illuminate\Support\Facades\DB;

function ZeroCondition($strNum){
    $retval = '';
    $length = strlen($strNum);
    if($length == 1){
        $retval = "000".$strNum;
    }else if($length==2){
        $retval = "00".$strNum;
    }else if($length==3) {
        $retval = "0" . $strNum;
    }
    else{
        $retval = $strNum;
    }
    return $retval;
}

function CheckAppliedJob($user_id, $job_id){
    $candidate = DB::table('applicant')
        ->where('user_id', '=', $user_id)
        ->where('job_id', '=', $job_id)
        ->count();

    if($candidate > 0){
        return true;
    }
    return false;
}

function GetLatestID($table_name){
    $table_id = $table_name.'_id';
    $data = DB::table($table_name)->orderBy($table_id, 'desc')->first();

    if($data){
        return intval(substr($data->{$table_name.'_id'}, 3));
    }
    return 0;
}

function GenerateId($table_name, $id_prefix){
    $id = "";
    if($table_name == 'users'){
        $data = DB::table($table_name)->orderByDesc('user_id')->first();
        $table_id = 'user_id';
    }else{
        $data = DB::table($table_name)->orderByDesc($table_name.'_id')->first();
        $table_id = strval($table_name).'_id';
    }

    if(!$data){
        $id = $id_prefix."0001";
    }else{
        $temp = intval(str_replace($id_prefix, '', $data->{$table_id}));
        $numid = ZeroCondition(strval($temp + 1));
        $id = $id_prefix.$numid;
    }
    return $id;
}

function GenerateCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function TimeSince($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}