<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    public $table = 'video_types';
    public $timestamps = false;
    protected $guarded = ['id'];
}
