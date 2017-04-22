<?php

namespace App\Http\Controllers\Service;

use App\Pet;


use App\Http\Requests;
use App\PetStatus;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KeDaController extends Controller
{



    /**
     * 添加宠物
     * 姓名 年龄 种类 性别 健康状况
     */
    public function addPet()
    {
        //验证
        $validator = Validator::make(
            rq(),
            [
                'name' => 'required|max:255|unique:pets,name',
                'age' => 'required|max:255|integer',
                'category'=>'required|max:20',
                'avatar_url' => 'active_url',
                'status' => 'integer'
            ],
            [
            ]
        );
        if ($validator->fails())
            return err(ERROR_CODE_PARAMS_ERROR,$validator->messages());

        //存储
        $pet = new Pet();
        $pet->name=rq('name');
        $pet->age=rq('age');
        $pet->category=rq('category');
        if(rq('avatar_url'))
            $pet->avatar_url=rq('avatar_url');
        if(rq('status'))
            $pet->status=rq('status');
        if(!$pet->save())
            return err(ERROR_CODE_DB_ERROR);
        return suc();

    }



    /**
     * 宠物日常情况监测
     * params: 宠物ID 进食质量
     */
    public function updateStatus()
    {
        //验证
        $validator = Validator::make(
            rq(),
            [
                'pet_id' => 'required|max:255|exists:pets,id',
                'weight' => 'required|min:0|integer',
            ],
            [
            ]
        );
        if ($validator->fails())
            return err(ERROR_CODE_PARAMS_ERROR,$validator->messages());

        //存储
        $pet_status = new PetStatus();
        $pet_status->pet_id=rq('pet_id');
        $pet_status->weight=rq('weight');
        if(!$pet_status->save())
            return err(ERROR_CODE_DB_ERROR);
        return suc();
    }

    public function getStatus()
    {
        //查出所有的ID集合
        $pets=DB::table('pets')->get(['id','name']);

        $data = [];

        foreach($pets as $pet)
        {

            $petstatus = DB::table('pet_status')->where(['pet_id'=>$pet->id])->limit(20)->orderBy('created_at')->get();
            $data[$pet->name] = $petstatus;

        }
        return suc($data);
    }


}
