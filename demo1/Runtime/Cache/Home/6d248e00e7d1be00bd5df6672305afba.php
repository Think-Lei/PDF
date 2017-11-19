<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
</head>
<body bgcolor="#faebd7" background="/demo1/Home/Public/Images/2.jpeg" >
    <form action='/demo1/index.php/home/register/add' method='post'>
        用户名：<input type="text" name="username" placeholder="用户名"><br><br>
        密&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" placeholder="密码"><br><br>
        确认密码：<input type="password" name="repassword" placeholder="确认密码"><br><br>
        验证码：<input id="j_verify" name="code" type="text" class="form-control x in" placeholder="点击刷新">
        <br><br>
           <!--- <input id="j_verify" name="code" type="text" class="form-control x in">-->
            <img id="verify_img" alt="点击更换" title="点击更换"
                 onclick='this.src=this.src+"?"+Math.random()'
                 src="<?php echo U('yanzhengma/verify',array());?>" class="m">
        <br>
        <input type="submit" style="width:155px;">
    </form>
</body>
</html>