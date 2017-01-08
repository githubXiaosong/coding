<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/28
 * Time: 18:48

 */

namespace  App\Inter;
abstract class AbstractInterface{
    /**
     * 输入校验
     * @param array $args 只负责输入参数的类型校验  不负责逻辑校验
     */
    protected $errorMeg;

    abstract public function _verifyInput();
    /**
     * 请求处理
     * 业务逻辑判断
     * 给客户端返回json
     */
    abstract public function _process();

    public function getErrorMsg()
    {
        return $this->errorMeg;
    }

     public function process(){
         if(!$this->_verifyInput())
             return err($this->errorMeg);
         return $this->_process();
     }






}