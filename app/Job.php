<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $table = 'job';
    protected $primaryKey = 'job_id';
    public $incrementing = false;

}
