<?php
/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/6
 * Time: 上午9:28
 */

namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class yanzhengmaController extends Controller
{
    /* 生成验证码 */
    public function verify()
    {
        $config = [
            'fontSize' => 19, // 验证码字体大小
            'length' => 4, // 验证码位数
            'imageH' => 34
        ];
        $Verify = new Verify($config);
        $Verify->entry();
    }

    /* 验证码校验 */
    public function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        $res = $verify->check($code, $id);
        $this->ajaxReturn($res, 'json');
    }
}