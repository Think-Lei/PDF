<?php
/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/14
 * Time: 上午11:35
 */
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller
{
    public function page()
    {
        $m = M("info");
        $total = $m->count();  //记录数据库的条数
        $per = 5;
        $Page=new \Think\Page($total,$per); //实例化分页类，传入总记录数和每页显示的记录数
        $show= $Page->show(); //分页显示输出
        //limit方法要使用Page类的属性
        $list = $m->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);  //赋值数据集
        $this->assign('p',$show);    //赋值分页输出
        $this->display();            //输出模版
    }
}