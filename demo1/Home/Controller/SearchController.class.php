<?php
/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/8
 * Time: 上午11:19
 */
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller{
    public function search()
    {
        $this->display();
    }
    public function do_search(){
        if(isset($_POST['username']) && $_POST['username']!=null)
        {
            $where['username']=array('like',"{$_POST['username']}");
        }

        $m=M("info");

        $arr=$m->where($where)->select();

        $this->assign('data',$arr);

        $this->display('search');
    }
}