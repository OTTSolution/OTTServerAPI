<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    public $table = 'market';
    public $timestamps = false;
    protected $fillable = ['icon_url', 'type', 'version', 'file', 'file_name', 'size', 'packageName'];
    
    public function photos(){
    	return $this->hasMany('App\Model\MarketPhoto', 'market_id', 'id')->select('photo_url');
    }

    public function descs(){
    	return $this->hasMany('App\Model\MarketDesc', 'market_id', 'id');
    }

}
