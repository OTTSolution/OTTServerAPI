<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Market;
use App\Model\MarketType;
use DB;
use Storage;

class MarketController extends Controller
{
    public function getIndex(){
    	$html = <<<HTML
        /api/market<br>
        所有：/allapp<br>
        推荐：/recommend<br>
        排行：/rank<br>
        分类：/types<br>
        分类列表：/type?type=<br>
        详情：/info?id=<br>
        版本号获取：/version?id=<br>
        下载：/download?id=
HTML;
        return $html;
    }

    public function getAllapp($lang_id = 1){
        $data = Market::join('market_types', 'type', '=', 'market_types.id')
            ->join('market_desc', function($join)use($lang_id){
                $join->on('market_id', '=', 'market.id')
                    ->where('lang_id', '=', $lang_id);
                })
            ->select(DB::raw('market.id as id, appName, icon_url, type_name as type'))
            ->orderBy(DB::raw('CONVERT(appName USING GBK)'))
            ->get();
        return $this->json(['data'=>$data]);
    }

    public function getRank($lang_id = 1){
        $data = Market::join('market_types', 'market_types.id', '=', 'type')
            ->join('market_desc', function($join)use($lang_id){
                $join->on('market_id', '=', 'market.id')
                    ->where('lang_id', '=', $lang_id);
                })
            ->select(DB::raw('market.id as id, appName, icon_url, type_name as type'))
            ->orderBy('downloads', 'desc')
            ->get();
        return $this->json(['data'=>$data]);
    }

    public function getTypes(){
        $data = MarketType::get();
        return $this->json(['data'=>$data]);
    }

    public function getType(Request $request, $lang_id = 1){
        $type = $request->input('type');
        $data = Market::join('market_types', 'market_types.id', '=', 'type')
            ->join('market_desc', function($join)use($lang_id){
                $join->on('market_id', '=', 'market.id')
                    ->where('lang_id', '=', $lang_id);
                })
            ->where('type', '=', $type)
            ->select(DB::raw('market.id as id, appName, icon_url'))
            ->get();
        return $this->json(['data'=>$data]);
    }

    public function getInfo(Request $request, $lang_id = 1){
        $id = $request->input('id');
        $data = Market::join('market_types', 'market_types.id', '=', 'type')
            ->join('market_desc', function($join)use($lang_id){
                $join->on('market_id', '=', 'market.id')
                    ->where('lang_id', '=', $lang_id);
                })
            ->select(DB::raw('market.id as id, appName, icon_url, type_name as type, `desc`, downloads, version, size, packageName'))
            ->find($id);
        if($data){
            $data->photos;
        }
        return $this->json($data);
    }

    public function getVersion(Request $request){
        $id = $request->input('id');
        $data = Market::select('version')->find($id);
        return $this->json($data);
    }

    public function getRecommend(Request $request, $lang_id = 1){
        $data = Market::join('market_types', 'market_types.id', '=', 'type')
            ->join('market_desc', function($join)use($lang_id){
                $join->on('market_id', '=', 'market.id')
                    ->where('lang_id', '=', $lang_id);
                })
            ->orderBy('downloads', 'desc')
            ->select(DB::raw('market.id as id, appName, icon_url, type_name as type'))
            ->where('recommend', '=', true)
            ->get();
        return $this->json(['data'=>$data]);
    }

    public function getDownload(Request $request){
        $id = $request->input('id');
        $data = Market::select('file', 'file_name', 'downloads')->find($id);
        if($data == null){
            return response()->make('file is not exist', 404);
        }
        $file = $data->file;
        $file_name = $data->file_name;
        if(!Storage::exists($file)){
            exit('file is not exist');
        }
        $data->update(['downloads'=>$data->downloads+1]);
        return response()->download(storage_path($file), $file_name, ['Content-Type: '.Storage::mimeType($file)]);
    }

    private function json($data){
        return response(json_encode($data, JSON_UNESCAPED_SLASHES))->header('Content-Type','application/json'); 
    }
}
