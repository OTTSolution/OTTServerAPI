<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $table = 'video';
    public $timestamps = false;
    protected $guarded = ['id'];
}
