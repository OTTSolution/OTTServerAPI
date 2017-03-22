<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class LeftController extends Controller
{
    public function getMarket(){
    	$types = DB::table('market_types')->select('id', 'type_name as type')->get();
    	return view('left-side.market', ['types'=>$types]);
    }

    public function getLive(){
    	$types = DB::table('live_types')->select('id', 'type_name as type')->get();
    	return view('left-side.live', ['types'=>$types]);
    }

    public function getVideo(){
    	$types = DB::table('video_types')->select('id', 'type_name as type')->get();
    	return view('left-side.video', ['types'=>$types]);
    }

    public function getTheme(){
        return '<div class="left-item" url="/theme" style="cursor:pointer;">所有主题</div>';
    }

    public function getApp(){
        return '<div class="left-item" url="/app" style="cursor:pointer;">APP列表</div>';
    }
    public function getPay(){
        return '<div class="left-item" url="/video_pay" style="cursor:pointer;">点播</div>';
    }
}
