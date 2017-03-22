<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Model\Theme;
use DB;
use Input;

class ThemeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index(){
		$themes = Theme::all();
		return view('right-side.theme.index', ['themes'=>$themes]);
	}

	public function create(){
		return view('right-side.theme.create');
	}

	public function store(Request $request){
    	$this->validate($request, [
    		'themeName' => 'required|max:255',
    		'themeCover' => 'required|image|max:2048',
    		'themeId.*' => 'required|digits_between:4,5',
    		'themeInfo.*' => 'required|image|max:2048'
		]);
		$input = Input::all();
		$input['themeCover'] = $this->fileStore(Input::file('themeCover'));

		$theme = Theme::create($input);
		if(Input::has('themeInfo')){
			$insertId = $theme->id;
			$themeId = $input['themeId'];
			$infos = Input::file('themeInfo');
			$i = 0;
			foreach ($infos as $file) {
				$fileName = $this->fileStore($file);
				DB::table('theme_infos')->insert(['themeUrl'=>$fileName, 'theme_id'=>$insertId, 'themId'=>$themeId[$i++]]);
			}
		}
		return redirect()->route('theme.show', ['id'=>$theme->id]);
	}

	public function edit($id){
		$theme = $this->idExists($id);
		return view('right-side.theme.edit', ['theme'=>$theme]);
	}

	public function show($id){
		$theme = $this->idExists($id);
		return view('right-side.theme.show', ['theme'=>$theme]);
	}

	public function update(Request $request, $id){
		$theme = $this->idExists($id);
    	$this->validate($request, [
    		'themeName' => 'required|max:255',
    		'themeCover' => 'image|max:2048',
    		'themeId.*' => 'required|digits_between:4,5',
    		'themeInfo.*' => 'required|image|max:2048'
		]);
		if(Input::hasFile('themeCover')){
			@unlink(public_path().$theme->themeCover);
			$theme->themeCover = $this->fileStore(Input::file('themeCover'));
		}
		$theme->themeName = Input::get('themeName');
		$theme->save();

		$infos = $theme->themeInfos;
		foreach($infos as $info){
			@unlink(public_path().$info->themeUrl);
		}
		DB::table('theme_infos')->where('theme_id', '=', $id)->delete();

		$themeId = Input::get('themeId');
		if(Input::hasFile('themeInfo')){
			$infos = Input::file('themeInfo');
			$i = 0;
			foreach ($infos as $file) {
				$fileName = $this->fileStore($file);
				DB::table('theme_infos')->insert(['themeUrl'=> $fileName, 'theme_id'=>$id, 'themId'=>$themeId[$i++]]);
			}
		}
		return redirect()->route('theme.show', ['id'=>$id]);
	}

	public function destroy($id){
		$theme = $this->idExists($id);
		$themeInfos = $theme->themeInfos;
		foreach ($themeInfos as $info) {
			$info->delete();
			@unlink(public_path().$info->themeUrl);
		}
		if($theme->delete()){
			@unlink(public_path().$theme->themeCover);
			return view('right-side.home', ['msg'=>'删除成功！', 'back'=>'/theme']);
		}else{
			return view('right-side.home', ['msg'=>'删除失败！', 'back'=>'/theme']);
		}
	}

	private function idExists($id){
		$theme = Theme::find($id);
		if($theme == null){
			abort(404);
		}
		return $theme;
	}

	private function fileStore($file){
		$store = '/static/images/';
		$fileName = md5(time().rand(0, 100000)).'.'.$file->getClientOriginalExtension();
		$file->move('.'.$store, $fileName);
		return $store.$fileName;
	}
}