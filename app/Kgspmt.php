<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kgspmt extends Model
{
    protected $table = 'kgspmt';
    protected $primaryKey ='PR_CD';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
