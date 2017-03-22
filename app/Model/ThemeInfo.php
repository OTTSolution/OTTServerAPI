<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ThemeInfo extends Model
{
    public $table = 'theme_infos';
    public $timestamps = false;
    protected $fillable = ['themeUrl', 'theme_id', 'themId'];
}
