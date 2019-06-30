<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    //
    protected $table = 'interview';
    protected $primaryKey = 'interview_id';
    public $incrementing = false;
}
