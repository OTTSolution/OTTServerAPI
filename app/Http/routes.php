<?php
use Illuminate\Support\Facades\Auth;
use DB;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication Routes...
// Route::get('login', 'Auth\AuthController@showLoginForm');
// Route::post('login', 'Auth\AuthController@login');
// Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
// Route::get('register', 'Auth\AuthController@showRegistrationForm');
// Route::post('register', 'Auth\AuthController@register');

// Route::auth();
Route::get('/', function(){
    return view('auth.login');
});

Route::group(['namespace'=>'API', 'prefix'=>'api'], function(){
	Route::controller('/market', 'MarketController');
	Route::controller('/video', 'VideoController');
	Route::controller('/weather','WeatherController');
	Route::controller('/', 'APIController');
});

Route::group(['namespace'=>'Web'], function(){
	Route::resource('theme', 'ThemeController');
	Route::resource('app', 'AppController');
	Route::resource('market', 'MarketController');
	Route::resource('live', 'LiveController');
	Route::resource('video', 'VideoController');
	Route::resource('welcome', 'WelcomeController');
	Route::resource('user_priv', 'UserPrivController');
	Route::controller('left', 'LeftController');
	Route::resource('manage','ManageController');
	Route::resource('video_pay', 'VideoPayController');
});

Route::auth();
/*
Route::get('manage', function(){
		$id=Auth::user()->id;
		$modules=array();
		//如果用户id为1则具有全部权限
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
	return view('layouts.manage',['modules'=>$modules]);

});*/