<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kgdata extends Model
{
    protected $table = 'kgdata';
    protected $primaryKey ='PR_NUM';
    public $incrementing = false;
    protected $keyType = 'string';
    // public $timestamps = false;
}
