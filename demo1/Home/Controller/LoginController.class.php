<?php

/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/6
 * Time: 上午9:12
 */
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{
  public function login(){
      $this->display();  //显示登录页面
  }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    public  function do_login()//进行登陆验证
    {
        session_start();
       // session::set('username',$_POST['username']);//将username存入session;
        if(empty($_POST['username']))
        {
            $this->error('帐号必须！');
        }

        else if (empty($_POST['code']))
        {
            $this->error('验证码必须！');
        }

        else if (empty($_POST['password']))
        {
            $this->error('密码必须！');
        }

        //dump($_SESSION);//调试方法
        $username=$_POST['username'];
        $password=$_POST['password'];
        $code=$_POST['code'];
        $_SESSION['username']=$username;

        if(!$this->check_verify($_POST['code'])) //md5是加密方式
        {
            $this->error('验证码错误！');//显示错误页面
        }


        $m=M('info');//连接表
        $where['username']=$username;
        $where['password']=$password;
        $i=$m->where($where)->count();

        if($username=="2014508010")
        {
            if($i>0)
            {
                $this->redirect('Admin/index');
            }
        }
        else if($i>0)
        {

            $this->redirect('User/user');//跳转
        }

        else
        {
            $this->error('用户名或密码错误');
        }

    }
}
?>