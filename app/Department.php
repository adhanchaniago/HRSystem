<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table = 'department';
    protected $primaryKey = 'department_id';
    public $incrementing = false;

}