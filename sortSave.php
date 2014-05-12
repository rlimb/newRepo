<?php
@session_start();
require_once('connect.php');

if(!isset($_GET['del']))
	{
	foreach($_POST['item'] as $k=>$v)
		mysql_query("UPDATE `photo` set `rang`='".($k+1)."' WHERE `id`='".$v."'",$dbcnx);
	}
else
	{
	if(isset($_SESSION['login']))
		{
		if(isset($_GET['numP']))
			{
			$id=$_GET['numP'];
			$res=mysql_fetch_array(mysql_query("SELECT `src` from `photo` WHERE `id`='".$id."'"));
			unlink("img/galery/".$res[0]);
			mysql_query("DELETE FROM `photo` WHERE `id`='".$id."'",$dbcnx);
			echo "$('#item-".$id."').hide();$('.bigImgCont').html('<h1>ОБЪЕКТ УДАЛЁН</h1>')";
			}
		}
	else
		echo "alert('необходима авторизация');";
	}
?>