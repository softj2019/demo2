<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kgmtb extends Model
{
    protected $table = 'kgmtb';
    protected $primaryKey ='name';
    public $incrementing = false;
    protected $keyType = 'string';
    // public $timestamps = false;
}
