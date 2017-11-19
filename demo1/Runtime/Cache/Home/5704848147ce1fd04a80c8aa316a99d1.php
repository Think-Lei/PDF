<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户信息分页表示</title>
</head>
<body>
<center>
<table border="0">
    <tr>
        <th >ID</th>
        <th >用户名</th>
        <th >密码</th>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo['id']); ?></td>
            <td><?php echo ($vo['username']); ?></td>
            <td><?php echo ($vo['password']); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>

<br><br><br>
<div><?php echo ($p); ?></div><br><br>
<a href="/demo1/index.php/Home/User/user.html">返回主页面</a>
</center>
<br><br>
</body>
</html>