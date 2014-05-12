<!DOCTYPE html>
<html lang="ru">
<head>
<title>Загрузка файла</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
<?php
@session_start();
if(!isset($_SESSION['login']))echo "window.close();";
?>
</script>
</head>

<body>
<?php
$src='';$descr='';$title='';
$wasErr=false;
$src=(isset($_POST['src'])?$_POST['src']:"");
$descr=(isset($_POST['descr'])?$_POST['descr']:"");
$title=(isset($_POST['title'])?$_POST['title']:"");
if(isset($_POST['send']))
{
require_once('connect.php');
require_once('imageLoad.php');
$image=new imageLoad($_FILES['itFile'],$src,$descr,$title,$dbcnx);

}
if(!isset($_POST['send'])||$image->wasErr)
{
if(isset($_POST['send'])&&$image->wasErr) echo "<font style='color:red;'>".$image->wasErr."</font><br>";
?>
<form enctype="multipart/form-data" action="#" method="POST">
название файла:<input type='text' name='src' value='<?php echo $src; ?>'><br>
заголовок:<input type='text' name='title' value='<?php echo $title; ?>'><br>
описание:<input type='text' name='descr' value='<?php echo $descr; ?>'><br>
файл:<input type='file' name='itFile'><br>
<input type='submit' value='отправить' name='send'>
</form>
<?php
}
?>
</body>
<html>
