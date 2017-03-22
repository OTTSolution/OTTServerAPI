<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VideoPay extends Model
{
    public $table = 'video_pays';
    public $timestamps = false;
    protected $guarded = ['id'];
}
