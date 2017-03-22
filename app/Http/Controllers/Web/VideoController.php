<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Model\Video;
use App\Model\VideoDesc;
use Input;
use DB;

class VideoController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index(){
		// $videos = Video::all();

		$type = Input::get('type', 1);
		$videos = Video::Where('type', '=', $type)->get();
		return view('right-side.video.index', ['videos'=>$videos,'type'=>$type]);
	}

	public function create(Request $request){
		$langs = DB::select("select lang_name,id from lang");
		$types = DB::select("select type_name,id from video_types");
		$ty = $request->input('type');
		return view('right-side.video.create',['langs'=>$langs,'types'=>$types,'ty'=>$ty]);
	}

	public function store(Request $request){
		$this->validate($request, [
    		'lang' => '',
    		'video_id' => 'required|max:2048',
    		'name' => 'required|',
    		'introduce' => '',
    		'detail' => '',
    		'photo_url' => 'required|',
    		'type' => '',
    		'url' => '',
    		'url_hd' => '',
    		'url_ud' => '',
    		'weight' => '',
    		'price' =>''
		]);
		$video_desc = new VideoDesc;
		$video_desc->video_id = $request->input('video_id');
		$video_desc->lang_id = $request->input('lang_id');
		$video_desc->name = $request->input('name');
		$video_desc->introduce = $request->input('introduce');
		$video_desc->detail = $request->input('detail');
		$video = new Video;
		$video->video_id = $request->input('video_id');
		$video->photo_url = $this->fileStore($request->file('photo_url'));
		$video->type = $request->input('type');
		$video->url = $request->input('url');
		$video->url_hd = $request->input('url_hd');
		$video->url_ud = $request->input('url_ud');
		$video->weight = $request->input('weight');
		$video->price = $request->input('price');
		if($video->save()&&$video_desc->save()){
			return redirect()->route('video.index',['type'=>$video->type]);
		}else{
			echo '保存失败';
		}
	}

	public function edit($id){
		$langs = DB::select("select lang_name,id from lang");
		$types = DB::select("select type_name,id from video_types");
		$video = DB::select("select * from video where video_id=?",[$id]);
		$video_desc = DB::select('select * from video_desc where video_id=?',[$id]);
		$la='';
		$ty='';
		if(count($video)>0&&count($video_desc)>0){
			$lang=DB::select("select lang_name from lang where id=?",[$video_desc[0]->lang_id]);
			$la=$lang[0]->lang_name;
			$type=DB::select('select type_name from video_types where id=?',[$video[0]->type]);
			$ty=$type[0]->type_name;
		}
		return view('right-side.video.edit', ['video'=>$video,'video_desc'=>$video_desc,'langs'=>$langs,'types'=>$types,'la'=>$la,'ty'=>$ty]);
	}
/*
	public function show($id){
		$video = DB::select("select * from video where id=?",[$id]);
		$video_desc = DB::select('select * from video_desc where id=?',[$id]);
		$lang='';
		$type='';
		if(count($video)>0&&count($video_desc)>0){
			$lang=DB::select("select lang_name from lang where id=?",[$video_desc[0]->lang_id]);
			$lang=$lang[0]->lang_name;
			$type=DB::select('select type_name from video_types where id=?',[$video[0]->type]);
			$type=$type[0]->type_name;
		}
		return view('right-side.video.show', ['video'=>$video,'video_desc'=>$video_desc,'lang'=>$lang,'type'=>$type]);
	}*/
	public function show($id){
		$video = DB::select("select * from video where video_id=?",[$id]);
		$video_desc = DB::select('select * from video_desc where video_id=?',[$id]);
		$lang='';
		$type='';
		if(count($video)>0&&count($video_desc)>0){
			$lang=DB::select("select lang_name from lang where id=?",[$video_desc[0]->lang_id]);
			$lang=$lang[0]->lang_name;
			$type=DB::select('select type_name from video_types where id=?',[$video[0]->type]);
			$type=$type[0]->type_name;
		}
		return view('right-side.video.show', ['video'=>$video,'video_desc'=>$video_desc,'lang'=>$lang,'type'=>$type]);
	}
	public function update(Request $request, $id){
		$video = DB::select("select * from video where video_id=?",[$id]);
		$video_desc = DB::select('select * from video_desc where video_id=?',[$id]);
		if(count($video)>0&&count($video_desc)>0){
				$this->validate($request, [
	    		'lang' => '',
	    		'video_id' => 'required|max:2048',
	    		'name' => 'required|',
	    		'introduce' => '',
	    		'detail' => '',
	    		'photo_url' => '',
	    		'type' => '',
	    		'url' => '',
	    		'url_hd' => '',
	    		'url_ud' => '',
	    		'weight' => '',
	    		'price' =>''
			]);
			//@unlink(public_path().$video->photo_url);
			$video_id = $request->input('video_id');
			$lang_id = $request->input('lang_id');
			$name = $request->input('name');
			$introduce = $request->input('introduce');
			$detail = $request->input('detail');
			DB::update('update video_desc set video_id = ?,lang_id=?,name=?,introduce=?,detail=? where video_id = ?', [$video_id,$lang_id,$name,$introduce,$detail,$id]);
			$video_id = $request->input('video_id');
			//$photo_url = $this->fileStore($request->file('photo_url'));
			$type = $request->input('type');
			$url = $request->input('url');
			$url_hd = $request->input('url_hd');
			$url_ud = $request->input('url_ud');
			$weight = $request->input('weight');
			$price = $request->input('price');
			//DB::update('update video set video_id = ?,photo_url=?,type=?,url=?,url_hd=?,url_ud=?,weight=?,price=? where video_id = ?', [$video_id,$photo_url,$type,$url,$url_hd,$url_ud,$weight,$price,$id]);
			if($request->file('photo_url')!=''){
				$photo_url = $this->fileStore($request->file('photo_url'));
				DB::update('update video set video_id = ?,photo_url=?,type=?,url=?,url_hd=?,url_ud=?,weight=?,price=? where video_id = ?', [$video_id,$photo_url,$type,$url,$url_hd,$url_ud,$weight,$price,$id]);
			}else{
				DB::update('update video set video_id = ?,type=?,url=?,url_hd=?,url_ud=?,weight=?,price=? where video_id = ?', [$video_id,$type,$url,$url_hd,$url_ud,$weight,$price,$id]);
			}
			return redirect()->route('video.index', ['type'=>$type]);
			
		}
		return view('right-side.home', ['msg'=>'操作失败！', 'back'=>'/video']); 
    	
	}

	public function destroy($id){
		$video = DB::select("select * from video where video_id=?",[$id]);
		if(count($video)>0){
			DB::delete('delete from video where video_id=?',[$id]);
			@unlink(public_path().$video->photo_url);
		}
		$video_desc = DB::select('select * from video_desc where video_id=?',[$id]);
		if(count($video_desc)>0){
			DB::delete('delete from video_desc where video_id=?',[$id]);
		}
		$type=isset($video[0]->type)?$video[0]->type:1;;
		return view('right-side.home', ['msg'=>'删除成功！', 'back'=>"/video?type=$type"]);
		
	}

	private function idExists($id){
		$video = Video::find($id);
		if($video == null){
			abort(404);
		}
		return $video;
	}

	private function fileStore($file){
		$store = '/static/images/';
		$fileName = md5(time().rand(0, 100000)).'.'.$file->getClientOriginalExtension();
		$file->move('.'.$store, $fileName);
		return $store.$fileName;
	}
}