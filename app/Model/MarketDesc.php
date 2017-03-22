<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MarketDesc extends Model
{
    public $table = 'market_desc';
    public $timestamps = false;
    protected $fillable = ['market_id', 'lang_id', 'appName', 'desc'];
}
