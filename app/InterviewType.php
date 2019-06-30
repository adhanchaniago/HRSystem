<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewType extends Model
{
    //
    protected $table = 'interview_type';
    protected $primaryKey = 'interview_type_id';
    public $incrementing = false;
}
