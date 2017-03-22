<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Market;
use App\Model\MarketType;
use App\Model\MarketDesc;
use App\Model\MarketPhoto;
use Storage;
use Input;
use DB;

class MarketController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
    	$lang_id = Input::get('lang_id', 1);
    	$type = Input::get('type', 1);
    	$market = Market::Leftjoin('market_types', 'market_types.id', '=', 'type')
    		->Leftjoin('market_desc', function($join)use($lang_id){
    			$join->on('market_id', '=', 'market.id')
    				->where('lang_id', '=', $lang_id);
    			})
    		->where('type', '=', $type)
    		->select(DB::raw('market.id as id, appName, icon_url'))
    		->paginate(10);
    	return view('right-side.market.index', ['market'=>$market,'type'=>$type]);
	}

    public function create(){
    	$types = MarketType::all();
    	$ty = Input::get('type',1);
    	return view('right-side.market.create', ['types'=>$types,'ty'=>$ty]);
    }

    public function store(Request $request){
    	$lang_id = Input::get('lang_id', 1);
    	$this->validate($request, [
    		'appName' => 'required|max:255',
    		'icon_url' => 'required|image|max:1024',
    		'photo_url.*' => 'required|image|max:1024',
    		'packageName' => 'required|max:255',
    		'version' => 'required|max:255',
    		'desc' => 'required|max:255',
    		'type' => 'required|max:255',
    		'file' => 'required|max:102400'
		]);
		$input = Input::all();
		$file = Input::file('file');
		$input['icon_url'] = $this->imageStore(Input::file('icon_url'));
		$input['file_name'] = $file->getClientOriginalName();
		$input['size'] = $file->getSize();
		$input['file'] = $this->fileStore($file);
		$market = Market::create($input);

		$input['lang_id'] = $lang_id;
		$input['market_id'] = $market->id;
    	$market_desc = MarketDesc::create($input);

    	$photos = Input::file('photo_url');
    	foreach ($photos as $photo) {
    		$photo_url = $this->imageStore($photo);
    		MarketPhoto::create(['market_id'=>$market->id, 'photo_url'=>$photo_url]);
    	}

		return redirect()->route('market.index', ['type'=>$input['type']]);
    }

	public function edit($id){
		$market = $this->find($id);
		$types = MarketType::all();
		$ty=Input::get('type',1);
		return view('right-side.market.edit', ['market'=>$market, 'types'=>$types,'ty'=>$ty]);
	}

	public function show($id){
		$market = $this->find($id);
		return view('right-side.market.show', ['market'=>$market]);
	}

	public function update(Request $request, $id){
		$lang_id = Input::get('lang_id', 1);
		$market = $this->find($id);
    	$this->validate($request, [
    		'appName' => 'required|max:255',
    		'icon_url' => 'image|max:1024',
    		'photo_url.*' => 'image|max:1024',
    		'packageName' => 'required|max:255',
    		'version' => 'required|max:255',
    		'desc' => 'required|max:255',
    		'type' => 'required|max:255',
    		'file' => 'max:102400'
		]);
		$input = Input::all();
		if(Input::hasFile('icon_url')){
			$icon_url = $market->icon_url;
			$this->delete($market->icon_url);
			$input['icon_url'] = $this->imageStore(Input::file('icon_url'));
		}
		if(Input::hasFile('file')){
			$file = $market->file;
			if(Storage::exists($file)){
				unlink(storage_path().$file);
			}
			$file = Input::file('file');
			$input['file_name'] = $file->getClientOriginalName();
			$input['size'] = $file->getSize();
			$input['file'] = $this->fileStore($file);
		}
		if(Input::hasFile('photo_url')){
			foreach($market->photos as $photo){
				$photo_url = $photo->photo_url;
				$this->delete($photo->photo_url);
			}
			MarketPhoto::where('market_id', '=', $market->id)->delete();
    		$photos = Input::file('photo_url');
    		foreach ($photos as $photo) {
    			if($photo){
    				$photo_url = $this->imageStore($photo);
    				MarketPhoto::create(['market_id'=>$market->id, 'photo_url'=>$photo_url]);
    			}
    		}
		}

		$market->update($input);
		$input['market_id'] = $id;
		$input['lang_id'] = $lang_id;
		$market_desc = MarketDesc::where('market_id', '=', $id)->where('lang_id', '=', $input['lang_id'])->first();
		if($market_desc == null){
			MarketDesc::create($input);
		}else{
			$market_desc->update($input);
		}
		return redirect()->route('market.show', ['id'=>$id,'type'=>$input['type']]);
	}

	public function destroy($id){
		$market = $this->find($id);
		$this->delete($market->icon_url);
		if(Storage::exists($market->file)){
			unlink(storage_path().$market->file);
		}
		foreach($market->photos as $photo){
			$this->delete($photo->photo_url);
		}
		MarketDesc::where('market_id', '=', $market->id)->delete();
		MarketPhoto::where('market_id', '=', $market->id)->delete();
		$market->delete();
		$ty=$market['type'];
		return view('right-side.home', ['msg'=>'删除成功！', 'back'=>"/market?type=$ty"]);
	}

	private function find($id){
		$lang_id = Input::get('lang_id', 1);
		$market = Market::Leftjoin('market_types', 'market_types.id', '=', 'market.type')
			->Leftjoin('market_desc', function($join)use($lang_id){
				$join->on('market_id', '=', 'market.id')
					->where('lang_id', '=', $lang_id);
				})
			->select(DB::raw('market.id as id, appName, icon_url, type, type_name, `desc`, version, packageName, file'))
			->find($id);
		if($market == null){
			abort(404);
		}
		return $market;
	}

	private function delete($url){
		if(!$url && $url != 'null' && file_exists(public_path().$url)){
			unlink(public_path().$url);
		}
	}

	private function imageStore($file){
		$store = '/static/images/market/';
		$fileName = md5(time().rand(0, 100000)).'.'.$file->getClientOriginalExtension();
		$file->move(public_path($store), $fileName);
		return $store.$fileName;
	}

	private function fileStore($file){
		$savePath = '/market/';
		$fileName = $savePath.md5(time().rand(0, 100000)).'.'.$file->getClientOriginalExtension();
		Storage::put($fileName, file_get_contents($file->getRealPath()));
		return $fileName;
	}

}
