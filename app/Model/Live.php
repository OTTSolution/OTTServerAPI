<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    public $table = 'live';
    public $timestamps = false;
    protected $fillable = ['num', 'url', 'name', 'type'];
   
}
