<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Model\App;
use Input;

class AppController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(){
    	$apps = App::all();
    	return view('right-side.app.index', ['apps'=>$apps]);
	}

    public function create(){
		return view('right-side.app.create');
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'appId'	  => 'required|numeric|unique:apps',
    		'appName' => 'required|max:255',
    		'appIcon' => 'required|image|max:1024',
    		'appPath' => 'required|max:255'
		]);

    	$app = App::create(Input::all());
		$app->appIcon = $this->fileStore(Input::file('appIcon'));
		if($app->save()){
			return redirect()->route('app.index');
		}else{
			echo '保存失败';
		}
    }

	public function edit($id){
		$app = $this->idExists($id);
		return view('right-side.app.edit', ['app'=>$app]);
	}

	public function show($id){
		$app = $this->idExists($id);
		return view('right-side.app.show', ['app'=>$app]);
	}

	public function update(Request $request, $id){
		$app = $this->idExists($id);
    	$this->validate($request, [
    		'appId'   => 'required|numeric',
    		'appName' => 'required|max:255',
    		'appIcon' => 'image|max:1024',
    		'appPath' => 'required|max:255',
		]);
		if(Input::hasFile('appIcon')){
			@unlink(public_path().$app->appIcon);
			$app->appIcon = $this->fileStore(Input::file('appIcon'));
		}

		$app->appId	  = $request->input('appId');
		$app->appName = $request->input('appName');
		$app->appPath = $request->input('appPath');
		$app->save();
		return redirect()->route('app.show', ['id'=>$id]);
	}

	public function destroy($id){
		$app = $this->idExists($id);
		@unlink(public_path().$app->appIcon);
		if($app->delete()){
			return view('right-side.home', ['msg'=>'删除成功！', 'back'=>'/app']);
		}else{
			return view('right-side.home', ['msg'=>'删除失败！', 'back'=>'/app']);
		}
	}

	private function idExists($id){
		$app = App::find($id);
		if($app == null){
			abort(404);
		}
		return $app;
	}

	private function fileStore($file){
		var_dump($file);
		$store = '/static/images/';
		$fileName = md5(time().rand(0, 100000)).'.'.$file->getClientOriginalExtension();
		$file->move('.'.$store, $fileName);
		return $store.$fileName;
	}
}
