<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Video;
use App\Model\VideoDesc;
use DB;


class ManageController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
		$id=Auth::user()->id;
		$modules=array();
		if($id==1){
			$modules_datas=DB::select("select name,url from user_modules");
			foreach($modules_datas as $modules_data){
				$modules[][]=$modules_data;
			}

		}else{
			$modules_id=DB::select("select modules_id from user_priv where user_id=?",[$id]);
			
			foreach($modules_id as $id){
				$modules[]=DB::select("select name,url from user_modules where id=?",[$id->modules_id]);
			}
		}
		if(count($modules)==0){
			return view('layouts.error');
		}
		return view('layouts.manage',['modules'=>$modules]);
	}

	
}