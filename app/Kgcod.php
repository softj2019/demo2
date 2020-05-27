<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kgcod extends Model
{
    protected $table = 'kgcod';
    protected $primaryKey ='num_cd';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
