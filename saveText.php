<?php
@session_start();
if(!isset($_SESSION['login']))exit("alert('Необходима авторизация');");
require_once('connect.php');

$text=$_GET['t'];

if($_GET['ph']==1)
	{
	$descOrTitle=substr($_GET['w'],2);
	mysql_query("UPDATE `photo` set `".$descOrTitle."`='".$text."' WHERE `id`='".$_GET['nph']."'",$dbcnx);
	echo $descOrTitle."Ph[".$_GET['r']."]='".$text."';";
	}
?>