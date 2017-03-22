<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public $table = 'themes';
    public $timestamps = false;
    protected $fillable = ['themeCover', 'themeName'];
    
    public function themeInfos(){
    	return $this->hasMany('App\Model\ThemeInfo', 'theme_id', 'id')->select('themId', 'themeUrl');
    }
}
