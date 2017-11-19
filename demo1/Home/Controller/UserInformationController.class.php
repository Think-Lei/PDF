<?php
/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/12
 * Time: 下午4:29
 */
namespace Home\Controller;
use Think\Controller;
class UserInformationController extends Controller
{
    public function information()
    {
        $value1 = session('username');//获得Login模块的session值
        $this->assign('name',$value1);//将value1的值传入模板,模板用{$name}调用
        $this->display();
    }
}