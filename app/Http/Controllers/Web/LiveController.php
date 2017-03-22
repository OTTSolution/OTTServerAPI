<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Model\Live;
use DB;

class LiveController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index(){
		$lives = Live::all();
		return view('right-side.live.index', ['lives'=>$lives]);
	}

	public function create(){
		return view('right-side.live.create');
	}

	public function store(Request $request){
		$this->validate($request, [
    		'type' => 'required|max:255',
    		'num' => 'required|max:2048',
    		'name' => 'required|',
    		'url' => 'required|max:2048'
		]);
		$live = new Live;
		$live->type = $request->input('type');
		$live->num = $request->input('num');
		$live->name = $request->input('name');
		$live->url = $request->input('url');;
		if($live->save()){
			return redirect()->route('live.index');
		}else{
			echo '保存失败';
		}
	}

	public function edit($id){
		$live = $this->idExists($id);
		return view('right-side.live.edit', ['live'=>$live]);
	}

	public function show($id){
		$live = $this->idExists($id);
		return view('right-side.live.show', ['live'=>$live]);
	}

	public function update(Request $request, $id){
		$live = $this->idExists($id);
    	$this->validate($request, [
    		'type' => 'required|max:255',
    		'num' => 'required|max:2048',
    		'name' => 'required|',
    		'url' => 'max:2048'
		]);
		//@unlink(public_path().$live->url);
		$type = $request->input('type');
		$num = $request->input('num');
		$name = $request->input('name');
		$url = $request->input('url');
		//$live->url = $this->fileStore($request->file('url'));
		//$live->save();
		
		DB::update('update live set type = ?,num=?,name=?,url=? where id = ?', [$type,$num,$name,$url,$id]);
		
		return redirect()->route('live.index', ['id'=>$id]);
	}

	public function destroy($id){
		$live = $this->idExists($id);
		@unlink(public_path().$live->url);
		if($live->delete()){
			return view('right-side.home', ['msg'=>'删除成功！', 'back'=>'/live']);
		}else{
			return view('right-side.home', ['msg'=>'删除失败！', 'back'=>'/live']);
		}
	}

	private function idExists($id){
		$live = Live::find($id);
		if($live == null){
			abort(404);
		}
		return $live;
	}

	private function fileStore($file){
		$store = '/static/images/';
		$fileName = md5(time().rand(0, 100000)).'.'.$file->getClientOriginalExtension();
		$file->move('.'.$store, $fileName);
		return $store.$fileName;
	}
}