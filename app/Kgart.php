<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kgart extends Model
{
    protected $table = 'kgart';
    protected $primaryKey ='AR_CD';
    public $incrementing = false;
    protected $keyType = 'string';
    // public $timestamps = false;
}
