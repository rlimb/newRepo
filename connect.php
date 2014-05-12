<?php
$sn=session_name();
$si=session_id();
$autorise="Авторизация:<br>
login: <input type='text' name='login' class='log' value=''><br>
password: <input type='password' name='pass' class='pas' value=''><br>
<input type='button' class='sendB' value='ok'>";

$dbcnx=@mysql_connect('localhost','mysql','kisa55555') or die ("нет подключения к базе : ".mysql_error());
mysql_select_db('zeleno',$dbcnx);
?>