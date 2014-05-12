<?php
@session_start();
if(isset($_GET['e']))
	{
	unset($_SESSION['login']);
	exit("window.location.reload();");
	}

require_once('connect.php');

if(isset($_GET['l'])&&isset($_GET['p'])&&$_GET['l']&&$_GET['p'])
	{
	$query="select `login`,`access` from `admin_users` WHERE `login`='".$_GET['l']."' and `password`='".md5($_GET['p'])."'";
	$myid=mysql_query($query,$dbcnx);
	if($res=mysql_fetch_assoc($myid))
		{
		$_SESSION['login']=$res['login'];
		$_SESSION['access']=$res['access'];
		echo "window.location.reload();";
		}
	else
		echo "alert('Неверный логин и пароль');";
	}
else
	{
	echo "alert('введите логин и пароль');";
	}


?>