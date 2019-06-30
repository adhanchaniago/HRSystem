<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    //
    protected $table = 'job_skill';
    protected $primaryKey = 'job_skill_id';
    public $incrementing = false;
}
