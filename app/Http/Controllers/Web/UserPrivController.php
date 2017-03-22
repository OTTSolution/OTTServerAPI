<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;

class UserPrivController extends Controller
{
    public function index(){
    	$users = DB::table('users')->where('id', '!=', 1)->select('id', 'name')->get();
    	return view('left-side.user', ['data'=>$users]);
    }

    public function show($id){
        $items = DB::table('user_modules')->LeftJoin('user_priv', function($join)use($id){
                $join->on('modules_id', '=', 'user_modules.id')
                    ->where('user_id', '=', $id);
                })
            ->select('user_modules.id as id', 'name', 'modules_id as check')->get();
        return view('right-side.manage.show', ['items'=>$items, 'id'=>$id]);
    }

    public function update($id){
        $input = Input::get('priv');
        $privs = [];
        DB::table('user_priv')->where('user_id', '=', $id)->delete();
        if(isset($input)){
            foreach($input as $item){
                $privs[] = ['user_id'=>$id, 'modules_id'=>$item];
            }
            DB::table('user_priv')->insert($privs);
        }
        return "保存成功";
    }

    private function json($data){
        return json_encode($data, JSON_UNESCAPED_SLASHES);
    }

}
