<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    public $table = 'apps';
    public $timestamps = false;
    protected $fillable = ['appId', 'appIcon', 'appName', 'appPath'];
}
