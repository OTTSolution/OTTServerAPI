<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MarketPhoto extends Model
{
    public $table = 'market_photos';
    public $timestamps = false;
    protected $fillable = ['market_id', 'photo_url'];
}
