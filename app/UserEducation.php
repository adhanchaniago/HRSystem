<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    //
    protected $table = 'user_education';
    protected $primaryKey = 'user_education_id';
    public $incrementing = false;
}
