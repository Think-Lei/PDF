<?php

/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/7
 * Time: 上午9:23
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller
{
    public function user()
    {
        $value1 = session('username');//获得Login模块的session值
        $this->assign('name',$value1);//将value1的值传入模板,模板用{$name}调用
        $this->display();//显示页面
    }

}