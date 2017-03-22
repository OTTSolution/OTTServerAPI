<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Model\VideoPay;
use DB;

class VideoPayController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index(){
		$video_pays = VideoPay::all();
		return view('videopay.index', ['video_pays'=>$video_pays]);
	}

	
}