<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/28
 * Time: 21:06
 */
namespace App\Inter;
use Illuminate\Support\Facades\Validator;

/**
 * Class FetchList
 * @package App\Inter
 * 不在设计单个地址的获取 直接返回列表 之中包含地址 在由列表页跳转到详情页的时候不向服务器要地址 只通知一下进入就行了
 */
class FetchList extends AbstractInterface
{

    /**
     *
     * 输入校验
     * @param array $args 输入参数
     */

    /**
     * @return bool
    Action FetchList
    flag	int	1:拉取在线直播列表 2:拉取7天内点播列表 3:拉取在线直播和7天内点播列表，直播列表在前，点播列表在后
    category_id int 种类ID
    user_id     int 主播用户ID
    pageno	int	分页号
    pagesize	int	每页大小
     */

    public function _verifyInput()
    {
        // TODO: Implement _verifyInput() method.

        /**
         * 自己的接口还是少做数据验证 不然太耗费SQL资源了
         */
        $validator = Validator::make(rq(),
            [
                'flag' => 'required|integer|min:0|max:255',
                'category_id' => 'integer',
                'user_id' => 'integer',
                'page' => 'integer|min:0',
                'limit' => 'integer'
            ],
            [
                /**
                 * todo bu todo ba
                 */
            ]);

        if( $validator->fails() ) {
            $this->errorMeg= $validator->messages();
            return false;
        }

        return true;
    }

    /**
     *
     * 请求处理
     */
    public function _process()
    {
        // TODO: Implement process() method.

        $l=get_limit_and_skip(rq('limit'));

        $rooms=roomins();
        //todo
        switch(rq('flag'))
        {
            case 1:
                /**
                 * flag	int	1:拉取在线直播列表 2:拉取7天内点播列表
                 * 3:拉取在线直播和7天内点播列表，直播列表在前，点播列表在后
                */
            break;
            default:
                return err('please input the flag');
                break;
        }

        if(rq('user_id'))
            $rooms = $rooms->where(['user_id'=>rq('user_id')]);
        if(rq('category_id'))
            $rooms=$rooms->where(['category_id'=>rq('category_id')]);

        $rooms=$rooms
            ->where(['status'=>1])
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get()
            ->keyBy('id');

        return suc(['rooms'=>$rooms]);
    }


}