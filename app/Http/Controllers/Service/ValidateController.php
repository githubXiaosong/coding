<?php

namespace App\Http\Controllers\Service;

use App\Helper\GlobalFunction;
use App\Helper\ValidateCode;

use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ValidateController extends Controller
{
    /**
     * @param $phone 发送的手机号
     *
     */
     const CODE_SUCCEED = 0;
     const CODE_ERROR = 1;
    const PHONE_VALIDATE_ERROR =2 ;

    public function sendSMS()
    {

        $validator = Validator::make(rq(),
            [
                'phone' => 'required|min:11|max:11|integer',
            ],
            [
                'phone.required' => '手机号不存在',
                'phone.min' => '手机号长度不正确',
                'phone.max' => '手机号长度不正确',
                'phone.integer' => '手机号必须为数字'
            ]);
        if( $validator->fails() )
            return GlobalFunction::returnModel(self::PHONE_VALIDATE_ERROR,$validator->messages());

        $code =rand(1000,9999);
        $s= new \App\Helper\RongLianYun\SendTemplateSMS();
        $result = $s->sendTemplateSMS(rq('phone') ,array($code,'5'),"1");
        Session::put('sendSMSCode',$code);
        if($result->statusCode == 000000)
            return GlobalFunction::returnModel(self::CODE_SUCCEED);
        return GlobalFunction::returnModel(self::PHONE_VALIDATE_ERROR);
    }



    public function createCode()
    {
        $validate = new ValidateCode();
        Session::put('validateCode',$validate->getCode());
        return $validate->doimg();
    }

}
