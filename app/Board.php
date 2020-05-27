<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'board';
    protected $primaryKey ='id';
    public $incrementing = true;
    // protected $keyType = 'string';
}
