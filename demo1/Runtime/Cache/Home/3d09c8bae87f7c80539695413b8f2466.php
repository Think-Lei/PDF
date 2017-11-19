<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询</title>
</head>
<body bgcolor="#faebd7">
<center>
    <form method="post" action='/demo1/index.php/home/search/do_search'>
        <input type="text" name="username" >
        <input type="submit">
    </form>
    <br><br><br>
    <table border="0">
        <tr>
            <th >ID</th>
            <th >用户名</th>
            <th >密码</th>
        </tr>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo['id']); ?></td>
                <td><?php echo ($vo['username']); ?></td>
                <td><?php echo ($vo['password']); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </table>
    <br><br><br>
    <div><?php echo ($page); ?></div><br><br>
    <div id="txt"></div>
    <br><br>
    <a href=" ">返回搜索页面</a >
    <a href="../User/user.html">返回主页面</a>
</center>
</body>
</html>