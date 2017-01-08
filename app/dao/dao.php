<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/1
 * Time: 17:36
 */
namespace App\dao;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class Dao
 * @package App\dao    dao层 不做数据验证和业务逻辑验证
 */
class Dao
{
    const ERROR_CODE_SUCCESS = 0;
    const ERROR_CODE_DB_ERROR = 1;
    const ERROR_CODE_ARRAY_ERROR = 2;
    const ERROR_CODE_INVALI_PARAMS= 3;
    const ERROR_NO_RET = 4;
    const TYPE_VIEWER_COUNT = 0;
    const TYPE_LIKE_COUNT = 1;
    const COUNT_ADD = 0;
    const COUNT_DEL = 1;
    const GET_LIST_TYPE_ONLINE = 0;
    const GET_LIST_TYPE_DATA_ALL = 1;
    /**
     * @param $userid
     * @param $live_code
     * @param $groupid
     * @param $title
     * @param $array_userinfo
     * @param $push_url
     * @param $pull_url
     * @param $hls_play_url
     * @param $now_time
     * @return int
     *
     */
    public function AddLiveUser($liver_id,$group_id,$title,$push_url,$play_url,$hls_play_url,$array_userinfo)
    {

            $liver=liverins()->find($liver_id?:0);
            if(!$liver)
                $liver=liverins();
            $liver->group_id=$group_id;
            $liver->title=$title;
            $liver->push_url=$push_url;
            $liver->play_url=$play_url;
            $liver->his_play_url=$hls_play_url;

            if(count($array_userinfo)!=0)
            {
                if(isset($array_userinfo['nickname']))
                {
                    $liver->nickname = $array_userinfo['nickname'];
                }
                if(isset($array_userinfo['headpic']))
                {
                    $liver->head_pic = $array_userinfo['headpic'];
                }
                if(isset($array_userinfo['frontcover']))
                {
                    $liver->front_cover = $array_userinfo['frontcover'];
                }
                if(isset($array_userinfo['location']))
                {
                    $liver->location = $array_userinfo['location'];
                }
                if(isset($array_userinfo['desc']))
                {
                    $liver->desc = $array_userinfo['desc'];
                }
            }

        if(!$liver->save())
            return ['status'=>self::ERROR_CODE_DB_ERROR];
        return ['status'=>self::ERROR_CODE_SUCCESS];
    }


    public function ChangeStatus()
    {
        //todo 这个方法应在callback接口中实现
    }

    /**
     * @param $user_id
     * @param $type
     * @param $optid
     * 暂时只有直播的
     * 不做业务逻辑   也就是保证$user_id必须要是对的
     */
    public function ChangeLiveCount($liver_id,$type,$optid)
    {

        if($type==self::TYPE_LIKE_COUNT)
        {
            if($optid==self::COUNT_ADD)
            {
                if(!liverins()->find($liver_id)->increment('like_count'))
                    return ['status'=>self::ERROR_CODE_DB_ERROR];
            }elseif($optid==self::COUNT_DEL)
            {
                if(!liverins()->find($liver_id)->decrement('like_count'))
                    return ['status'=>self::ERROR_CODE_DB_ERROR];
            }else
            {
                return ['status'=>self::ERROR_CODE_INVALI_PARAMS];
            }
        }elseif($type==self::TYPE_VIEWER_COUNT){
            if($optid==self::COUNT_ADD)
            {
                if(!liverins()->find($liver_id)->increment('view_count'))
                    return ['status'=>self::ERROR_CODE_DB_ERROR];
            }elseif($optid==self::COUNT_DEL)
            {
                if(!liverins()->find($liver_id)->decrement('view_count'))
                    return ['status'=>self::ERROR_CODE_DB_ERROR];
            }else
            {
                return ['status'=>self::ERROR_CODE_INVALI_PARAMS];
            }
        }else{
            return ['status'=>self::ERROR_CODE_INVALI_PARAMS];
        }
        return ['status'=>self::ERROR_CODE_SUCCESS];
    }


    public function ModifyLiveStatus($userid,$status)
    {
        return $this->CallBackLiveStatus($userid,$status);
    }

    /**
     * 获取所有的或者在线的列表
     */
    public function GetDataList($type,$pageno,$pagesize)
    {
        $l=get_limit_and_skip($pagesize,$pageno);
        $livers=liverins();
        if($type==self::GET_LIST_TYPE_ONLINE)
        {
            $livers=$livers->where('status',1);

        }else if($type==self::GET_LIST_TYPE_DATA_ALL)
        {

        }else{
            return self::ERROR_CODE_INVALI_PARAMS;
        }

        $livers =$livers
            ->orderBy('created_at','desc')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        if($livers)
            return ['status'=>self::ERROR_CODE_SUCCESS,'data'=>['livers'=>$livers]];
        return ['status'=>self::ERROR_CODE_DB_ERROR];
    }

    /**
     * 通知服务器有成员进入   有改无加
     */
    public function AddGroupInfo($user_id,$liver_id,$group_id,$nickname,$head_pic)
    {
        /**
         * 有改无加
         */
        if(!(groupins()->where(['user_id'=>$user_id,'group_id'=>$group_id,'liver_id'=>$liver_id])->first())) {
                $group=groupins();
            if (isset($user_id))
                $group->user_id = $user_id;
            if (isset($liver_id))
                $group->liver_id = $liver_id;
            if (isset($group_id))
                $group->group_id = $group_id;
            if (isset($nickname))
                $group->nickname = $nickname;
            if (isset($head_pic))
                $group->head_pic = $head_pic;

            if (!$group->save())
                return ['status' => self::ERROR_CODE_DB_ERROR];

            return ['status' => self::ERROR_CODE_SUCCESS];
        }else{
            if(DB::table('groups')
                ->where([
                    'user_id' => $user_id,
                    'group_id' => $group_id,
                    'liver_id' => $liver_id
                ])
                ->update([
                    'nickname' => $nickname,
                    'head_pic' => $head_pic
                ]))
                return ['status' => self::ERROR_CODE_SUCCESS];
            return ['status' => self::ERROR_CODE_DB_ERROR];
        }
    }

    public function RemoveGroupInfo($userid,$liverid,$groupid)
    {
        if(DB::table('groups')->where([
            'user_id' => $userid,
            'liver_id' => $liverid,
            'group_id' => $groupid
        ])->delete())
            return ['status'=>self::ERROR_CODE_SUCCESS];
        return ['status'=>self::ERROR_CODE_DB_ERROR];
    }

    /**
     * @param $liver_id
     * @param $group_id
     * @param $page_num
     * @param $page_size
     * @return array
     * group id 传空或者0的时候就会就会返回整个liver_id
     */
    public function GetGroupList($liver_id,$group_id,$page_num,$page_size)
    {
        $l=get_limit_and_skip($page_size,$page_num);

        $groups=groupins()
            ->where([
                'liver_id' => $liver_id
            ]);
        if(!empty($group_id))
            $groups=$groups
                ->where([
                'group_id' => $group_id
            ]);

            $groups=$groups
            ->orderBy('created_at','desc')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get();

        if(!$groups)
            return ['status'=>self::ERROR_CODE_DB_ERROR];
        return ['status'=>self::ERROR_CODE_SUCCESS,'data'=>['groups'=>$groups]];

    }

    public function GetGroupListCount($liver_id,$group_id)
    {
        $group=groupins()->where('liver_id',$liver_id);
        if(!empty($group_id))
            $group=$group->where('group_id',$group_id);
        $count=$group->count();

        if(!isset($count))
            return ['status' => self::ERROR_CODE_DB_ERROR];
        return ['status' => self::ERROR_CODE_SUCCESS , 'data'=>[ 'count' => $count]];
    }

    public function GetLiverInfo($liver_id)
    {
        $ret=liverins()->find($liver_id);
        if($ret)
            return ['status'=>self::ERROR_CODE_SUCCESS,'data'=>['liver'=>$ret]];
        return ['status'=>self::ERROR_NO_RET];
    }

    /**
     * 得到所有的直播条数
     */
    public function GetAllLiveCount()
    {
        $count=liverins()->count();
        if(!isset($count))
            return ['status' => self::ERROR_CODE_DB_ERROR];
        return ['status' => self::ERROR_CODE_SUCCESS , 'data'=>[ 'count' => $count]];
    }

    /**
     * @param $stream_id
     * @param $userinfo
     * private ???
     */
    private function getLiveUser($stream_id,&$userinfo)
    {

    }


    /**
     * @param $liver_id
     * @param $status
     * 0 断流 1 开启 3关闭
     */
    public function UpdateCheckStatus($liver_id,$status)
    {
        if($status!=1)
//            只要不是1 并且checkstatus为2 的就 设为断流同时把checkstatus清零
//            如果checkstatus不是2就把checkstastus+1

        {
            $liver = liverins()->find($liver_id);
            $ret=null;
            if(!$liver)
                return [ 'status' => self::ERROR_NO_RET ] ;
            if($liver->check_status == 2)
                $ret=DB::table('livers')->where('id', $liver_id)->update(['check_status' => 0,'status' => 0]);
            else
                $ret= DB::table('livers')->where('id', $liver_id)->increment('check_status');
        }
        if(!$ret)
            return [ 'status' => self::ERROR_CODE_DB_ERROR ] ;
        return [ 'status' => self::ERROR_CODE_SUCCESS ] ;
    }

    public function CallBackLiveStatus($stream_id,$status)
    {
         if(DB::table('livers')->where('id', $stream_id)->update(['status' => $status]))
         {
             return [ 'status' => self::ERROR_CODE_DB_ERROR ] ;
         }
        return [ 'status' => self::ERROR_CODE_SUCCESS ] ;
    }


    public function GetOnlineStreamId()
    {
        $data = liverins()->where('status',1)->get(['id']);
        if(!isset($data))
            return ['status' => self::ERROR_CODE_DB_ERROR];
        return ['status' => self::ERROR_CODE_SUCCESS ,'data' => [
            'list' => $data
        ]];
    }

    /**
     * 返回传入的用户ID和状态是不是和数据库中的相同 is_same 字段相同返回true不相同返回false
     * @param $liver_id
     * @param $status
     */
    public function IsSameLiverForbidStatus($liver_id,$status)
    {


        $db_flag=liverins()->where(['id' => $liver_id])
            ->get(['forbid_flag']);

        if(!$db_flag)
            return ['status' => self::ERROR_CODE_DB_ERROR];

         if($db_flag[0]['forbid_flag']==$status){
             return ['status' => self::ERROR_CODE_SUCCESS ,'data' => [
                 'is_same' => 0
             ]];
         }
        return ['status' => self::ERROR_CODE_SUCCESS ,'data' => [
            'is_same' => 1
        ]];
    }

    public function ChangeForbidStatusLiver($stream_id,$status)
    {
        $ret=DB::table('livers')->where(['id' => $stream_id])->update(['forbid_flag' => $status]);
        if(!$ret)
            return ['status' => self::ERROR_CODE_DB_ERROR];

        return [ 'status' => self::ERROR_CODE_SUCCESS ] ;
    }




}