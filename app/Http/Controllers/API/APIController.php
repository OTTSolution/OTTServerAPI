<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Model\Theme;
use App\Model\App;
use DB;

class APIController extends Controller
{
	public function getIndex(Request $request){
		$html = <<<HTML
    	theme接口:<a href='/api/theme'>/theme</a><br><br>
        app接口:<a href='/api/app-list'>/app-list</a><br><br>
        应用商店接口:<a href='/api/market'>/market</a><br><br>
        video接口:<a href='/api/video'>/video</a><br><br>
        live接口：<a href='/api/live'>/live</a><br><br>
        天气接口：<a href='/api/weather'>/weather</a>
HTML;
		return $html;
	}

    public function getTheme(Request $request){
		$theme = Theme::OrderBy('id', 'desc')->first();
		$infos = [];
		foreach($theme->themeInfos as $info){
			 $infos[] = ["themId" => $info->themId, "themUrl" => $request->root().$info->themeUrl];
		}
		return response(json_encode([
			"them" => [
				"themCover" => $request->root().$theme->themeCover,
				"themName" => $theme->themeName,
				"themsId" => $theme->id,
				"themInfo" => $infos
			]
		], JSON_UNESCAPED_SLASHES))->header('Content-Type', 'application/json');
    }

    public function getAppList(Request $request){
    	$data = DB::select('SELECT appId, appName, appIcon, appPath from apps');
    	foreach($data as $item){
    		$item->appIcon = $request->root().$item->appIcon;
    	}
    	return response(json_encode(['data'=>$data], JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');
    }

    public function getLive(){
    	$data = DB::select('SELECT type_name as type, num, name, url from live l left join live_types t on t.id = l.type Order by num');
    	return response(json_encode(['data'=>$data], JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');
    }
}
