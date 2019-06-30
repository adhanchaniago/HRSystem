<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $table = 'document';
    protected $primaryKey = 'document_id';
    public $incrementing = false;
}
