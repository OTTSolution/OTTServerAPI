<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\VideoType;
use App\Model\Video;
use DB;
use Input;

class VideoController extends Controller
{
	public function getIndex(){
		return "/types<br>/type?type=<br>/info?id=<br>/payinfo?video_id=&user_id=（返回值说明：1：影片未购买；2：影片已购买并且在有效期内；3：影片已购买但已过期）<br>/pay?video_id=&user_id=";
	}

    public function getTypes(){
    	$data = VideoType::get();
    	return $this->json(['data'=>$data]);
    }

    public function getType(Request $request){
        $lang_id = Input::get('lang_id', 1);
        $type = $request->input('type');
        $data = Video::Leftjoin('video_types', 'video_types.id', '=', 'video.type')
            ->Leftjoin('video_desc', function($join)use($lang_id){
                $join->on('video_desc.video_id', '=', 'video.video_id')
                    ->where('lang_id', '=', $lang_id);
                })
            ->where('type', '=', $type)
            ->select(DB::raw("video.id as id, name, concat('{$request->root()}', photo_url) as photo, type_name as type"))
            ->get();
        return $this->json(['data'=>$data]);
    }

    public function getInfo(Request $request){
        $lang_id = Input::get('lang_id', 1);
        $id = $request->input('id');
        $data = Video::Leftjoin('video_types', 'video_types.id', '=', 'video.type')
            ->Leftjoin('video_desc', function($join)use($lang_id){
                $join->on('video_desc.video_id', '=', 'video.video_id')
                    ->where('lang_id', '=', $lang_id);
                })
            ->select(DB::raw("video.id as id, name, concat('{$request->root()}', photo_url) as photo, type_name as type, detail, score, concat('http://10.10.10.200:80', url) as url, introduce, price"))
            ->find($id);
        return $this->json($data);
    }
    
    public function getPayinfo(Request $request){
        $video_id=$request->input('video_id');
        $user_id=$request->input('user_id');
        $data = DB::select("select id from video_pays where user_id=? and video_id=?",[$user_id,$video_id]);
        if(count($data)==0){
            $result['tag']=1;
            return response(json_encode(['result'=>$result], JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');
        }else{
           $now_time = time();
           $pay_time = DB::select("select pay_time from video_pays where user_id=? and video_id=?",[$user_id,$video_id]);
           $pay_time = strtotime($pay_time[0]->pay_time);
           if($now_time<$pay_time+60*60*24*3){
            //影片在有效期内（有效期默认三天）
                $result['tag']=2;
                return response(json_encode(['result'=>$result], JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');
           }else{
            //影片购买已过期
                 $result['tag']=3;
                return response(json_encode(['result'=>$result], JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');
           }

        }
    }
    public function getPay(Request $request){
        $video_id=$request->input('video_id');
        $user_id=$request->input('user_id');
        $time = date('Y-m-d H:i:s',time());;
        $data = DB::select("select id from video_pays where user_id=? and video_id=?",[$user_id,$video_id]);
        if(count($data)==0){
            //插入
           DB::insert('insert into video_pays (user_id, video_id, pay_time) values (?, ?, ?)',[$user_id,$video_id,$time]);
            $result['tag']='success';
                return response(json_encode(['result'=>$result], JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');

        }else{
            //更新
           $affected = DB::update("update video_pays set pay_time = ? where user_id=? and video_id=?",[$time,$user_id,$video_id]);
           $result['tag']='success';
                return response(json_encode(['result'=>$result], JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');

        }
    }

    private function json($data){
        return response(json_encode($data, JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json');
    }
}
