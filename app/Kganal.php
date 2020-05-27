<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kganal extends Model
{
    protected $table = 'kganal';
    protected $primaryKey ='PR_NUM';
    public $incrementing = false;
    protected $keyType = 'string';
}
