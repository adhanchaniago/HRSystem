<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppProgress extends Model
{
    //
    protected $table = 'application_progress';
    protected $primaryKey = 'application_progress_id';
    public $incrementing = false;
}
