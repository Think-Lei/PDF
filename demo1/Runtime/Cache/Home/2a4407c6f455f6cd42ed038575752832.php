<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>更新用户信息</title>
</head>
<body bgcolor="#ffc0cb">
<center>
    你好,<?php echo ($name); ?>!你可以完善以下信息
    <form action='/demo1/index.php/home/update/do_update' method='post'>
        用户名<input type="username" name="username" placeholder="用户名"><br><br>
        密&nbsp;码<input type="password" name="password" placeholder="密码"><br><br>
        确认密码<input type="password" name="repassword" placeholder="确认密码"><br><br>
        <input type="submit" style="width:155px;">
    </form>
</center>
</body>
</html>