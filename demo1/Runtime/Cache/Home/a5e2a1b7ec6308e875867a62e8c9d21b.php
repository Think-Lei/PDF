<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>excel 导入／导出</title>
</head>
<body bgcolor="#ffc0cb">
<a href="/demo1/index.php/home/eximport/export" >导出为excel</a>
<br>
<br>
<a href="/demo1/index.php/home/eximport/exportpdf">导出为PDF</a>
<br>
<br>
<form action="/demo1/index.php/home/eximport/import" enctype="multipart/form-data" method="post" >
    <input type="file" name="excel" />
    <input type="submit" value="提交" >
</form>
</body>
</html>