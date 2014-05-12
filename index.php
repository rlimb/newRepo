<?php
@session_start();
require_once('connect.php');
$isG=isset($_GET['g']);
$isT=isset($_GET['t']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<title>Ландшафтный дизайн</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="css/main.css" rel="stylesheet" />

<script type="text/javascript" src="scripts/main.js"></script>
<script type="text/javascript" src="scripts/jquery.1.8.2.js"></script>
<script type="text/javascript" src="scripts/nicEdit.js"></script>
<script>
<?php echo "var sn='".$sn."',si='".$si."',globId;"; ?>
$(document).ready(function(){
$('.sendB').click(adminFunc.verifMe);
$('.exitB').click(adminFunc.verifMe);

<?php if($isG) echo "
$('.litImg').click(adminFunc.showBImg);
$('.addPh').click(adminFunc.newImg);";
?>
});
</script>

<?php
if($isG)
	{
	$myid=mysql_query("SELECT * from `photo` where 1 order by `rang`",$dbcnx);

	$descPhotos=array();
	$titlPhotos=array();
	$litPhotos='';
	while($res=mysql_fetch_assoc($myid))
		{
		$descPhotos[]=$res['rang']."':'".str_replace("'","`",$res['desc']);
		$titlPhotos[]=$res['rang']."':'".str_replace("'","`",$res['title']);
		$idPhotos[]=$res['rang']."':'".$res['id'];
		$litPhotos.="<li id='item-".$res['id']."'><img alt='".$res['rang']."' src='img/galery/".$res['src']."' class='litImg'></li>";
		}
	
	echo "
	<link href='css/galery.css' rel='stylesheet' />
			
	<script src='scripts/sortable.js'></script>

	<script>
	var descPh={'".implode("','",$descPhotos)."'};
	var titlePh={'".implode("','",$titlPhotos)."'};
	var idPh={'".implode("','",$idPhotos)."'};
	$(function() {
		$('#sortable').sortable({
		cursor: 'move',
		update: function() {
			var sendData=$(this).sortable('serialize');
			$.ajax({
				url: 'sortSave.php',
				type: 'POST',
				data: sendData
			});
		}
		});
		$('#sortable').disableSelection();
	  });
	</script>
	";
}
elseif($isT)
	{
	echo "<link href='css/text_man.css' rel='stylesheet' />";
	}
?>

</head>

<body>
<?php
if(isset($_SESSION['login']))
	{
	
	if($isG) // block of edit galery
		{
		echo "
		<b>редактор галереи</b> <a href='?t=1' class='edT'>редактор статей</a>	<a href='#' class='exitB'>выход</a>
		
		<a href='#' class='addPh'>Добавить новое фото</a><br><br>
		<div class='litImgCont'><ul id='sortable'>".$litPhotos."</ul></div>
		<div class='bigImgCont'></div>
		
		
		<div class='asker'></div>
		";
		}
	elseif(isset($_GET['t'])) //block of edit text
		{
		echo "<a href='?g=1' class='edG'>редактор галереи</a> <b href='?t=1' class='edT'>редактор статей</b>	<a href='#' class='exitB'>выход</a>";
		
		}
	else //default start menu
		echo "<a href='?g=1'>редактор галереи</a><br>
		<a href='t=1'>редактор статей</a><br>
		<a href='#' class='exitB'>выход</a>";
	}
else echo $autorise;
?>

</body>
<html>
