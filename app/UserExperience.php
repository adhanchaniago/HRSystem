<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    //
    protected $table = 'user_experience';
    protected $primaryKey = 'user_experience_id';
    public $incrementing = false;
}
