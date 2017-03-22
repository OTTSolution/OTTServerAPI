<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Market;
use App\Model\MarketType;
use DB;
use Storage;

class WeatherController extends Controller
{
    public function getIndex(){
    	$html = <<<HTML
        根据IP获取天气：/ipweather<br>
        根据IP获取天气(IP固定，局域网测试使用)：/test<br>
        根据城市名获取天气：/citynameweather?cityname=<br>
        根据城市代码获取天气：/citycodeweather?citycode=
HTML;
        return $html;
    }

    public function getIpweather(Request $request){
        $data='';
        $onlineip='202.158.177.67';
        if(getenv('HTTP_CLIENT_IP')) { 
        $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')) { 
        $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')) { 
        $onlineip = getenv('REMOTE_ADDR');
        } else { 
        $onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
        }
        //$url='http://ip.taobao.com/service/getIpInfo.php?ip='.$onlineip;
        $url='http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$onlineip;
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        $cityname=isset($data['city'])?$data['city']:'';
        $data=DB::table('weathers_ch')->where('city','=',"$cityname")->first();
        return $this->json(['data'=>$data]);
    }

    public function getCitynameweather(Request $request){
        $data='请输入城市名称';
        if(!empty($request->input('cityname'))){
            $cityname=$request->input('cityname');
            $data=DB::table('weathers_ch')->where('city',$cityname)->first();
        }
        
        return $this->json(['data'=>$data]);
    }

    public function getCitycodeweather(Request $request){
        $data='请输入城市代码';
        if(!empty($request->input('citycode'))){
            $citycode=$request->input('citycode');
            $data=DB::table('weathers_ch')->where('citycode',$citycode)->first();
        }
        return $this->json(['data'=>$data]);
    }

    private function json($data){
        return response(json_encode($data, JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json'); 
    }
    public function getTest(){
        $data='';
        $onlineip='202.158.177.67';
        if(getenv('HTTP_CLIENT_IP')) { 
        $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')) { 
        $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')) { 
        $onlineip = getenv('REMOTE_ADDR');
        } else { 
        $onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
        }
        $onlineip='202.158.177.67';
        //$url='http://ip.taobao.com/service/getIpInfo.php?ip='.$onlineip;
        $url='http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$onlineip;
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        print_r($data);exit;
        $cityname=isset($data['city'])?$data['city']:'';
        $data=DB::table('weathers_ch')->where('city','=',"$cityname")->first();
        return $this->json(['data'=>$data]);
    }
    
}
