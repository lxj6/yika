<?php


namespace App\Http\Controllers;


use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{

    public function index(){
        $msgs = Message::orderBy('created_at','DESC')->paginate(20);
        $msgs->withPath('/message/index');
        return view('message/index',['msgs'=>$msgs]);
    }

    public function change_return(Request $request){
        if($request->isMethod('post')){
            $id = $request->input('id');
            Message::where('id',$id)->update(['is_return' => 1]);
            return response()->json(['code'=>200,'msg'=>'修改成功']);
        }
    }

    public function change_interest(Request $request){
        if($request->isMethod('post')){
            $id = $request->input('id');
            Message::where('id',$id)->update(['is_interest' => $request->status]);
            return response()->json(['code'=>200,'msg'=>'修改成功']);
        }
    }

    public function del_msg(Request $request){
        if($request->isMethod('post')){
            $id = $request->input('id');
            Message::destroy($id);
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }
    }

    public function sendSms(Request $request){
        $data['phone'] = $request->input('phone');
        $data['code'] = mt_rand(1000,9999);
        $count = Message::where('phone',$data['phone'])->count();
        if($count >= 3){
            $return = [
                'code' => 400,
                'msg' => '留言次数已达上限',
            ];
            return response()->json($return);
        }
        $send = sendsms($data['phone'],$data['code']);
        if($send){
            $data['validate'] = time()+300;
            DB::table('sms')->insert($data);

            $return = [
                'code' => 200,
                'msg' => '验证码发送成功',
            ];
            return response()->json($return);
        }

    }

    public function submitMsg(Request $request){
        $name = $request->input('name');
        $phone = $request->input('phone');
        $code = $request->input('code');
        $detail = $request->input('detail');

        $sms = DB::table('sms')->where('phone',$phone)->orderBy('validate','DESC')->first();

        if($sms){
            if(time() > $sms->validate){
                $return = [
                    'code' => 400,
                    'msg' => '验证码已过期，请重新获取',
                ];
                return response()->json($return);
            }
            if($code != $sms->code){
                $return = [
                    'code' => 400,
                    'msg' => '验证码输入有误',
                ];
                return response()->json($return);
            }

            $count = Message::where('phone',$phone)->count();
            if($count >= 3){
                $return = [
                    'code' => 400,
                    'msg' => '留言次数已达上限',
                ];
                return response()->json($return);
            }

            Message::create(['name'=>$name,'phone'=>$phone,'detail'=>$detail]);

            $return = [
                'code' => 200,
                'msg' => '提交成功',
            ];

            return response()->json($return);

        }else{
            $return = [
                'code' => 400,
                'msg' => '验证码无效',
            ];
            return response()->json($return);
        }

    }


}

