<?php

namespace App\Http\Controllers;

use App\AdminConf;
use Illuminate\Http\Request;

class SystemController extends BaseController
{


    public function index(Request $request){

        if($request->isMethod('post')){
            AdminConf::where('id',1)->update($request->all());

            $data = [
                'code' => 200,
                'msg'  => '更新成功',
            ];
            return response()->json($data);

        }
        $res = AdminConf::first();
        return view('system\index',['conf'=>$res]);
    }
}
