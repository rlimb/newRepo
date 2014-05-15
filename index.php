<?php
@session_start();
$isG=isset($_GET['g']);
$isT=isset($_GET['t']);
require_once('connect.php');
if($isG||$isT)require_once('imageLoad.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<title>фотоальбом</title>
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
elseif($isT) echo "
$('.litImg').click(adminFunc.showBImgView);";
?>
});
</script>

<?php
if($isG)
	{
	$photoCl=new imageView($_SESSION['login'],$dbcnx);
	$photoCl->getPhoto(1);
	
	echo "
	<link href='css/galery.css' rel='stylesheet' />
			
	<script src='scripts/sortable.js'></script>

	<script>
	var descPh={'".implode("','",$photoCl->descPhotos)."'};
	var titlePh={'".implode("','",$photoCl->titlPhotos)."'};
	var idPh={'".implode("','",$photoCl->idPhotos)."'};
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
	$photoCl=new imageView((isset($_SESSION['login'])?$_SESSION['login']:'none'),$dbcnx);
	$photoCl->getPhoto(2);
	echo "<link href='css/galeryView.css' rel='stylesheet' />";
	echo "<script>
	var descPh={'".implode("','",$photoCl->descPhotos)."'};
	var titlePh={'".implode("','",$photoCl->titlPhotos)."'};
	var idPh={'".implode("','",$photoCl->idPhotos)."'};</script>";
	
	
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
		<b>редактор галереи</b> <a href='?t=1' class='edT'>просмотр галереи</a>	<a href='#' class='exitB'>выход</a>
		
		<a href='#' class='addPh'>Добавить новое фото</a><br><br>
		<div class='litImgCont'><ul id='sortable'>".$photoCl->litPhotos."</ul></div>
		<div class='bigImgCont'></div>
		
		
		<div class='asker'></div>
		";
		}
	elseif(isset($_GET['t'])) //block of edit text
		{
		
		echo "<a href='?g=1' class='edG'>редактор галереи</a> <b href='?t=1' class='edT'>просмотр галереи</b>	<a href='#' class='exitB'>выход</a>";
		
		echo "<div class='litImgCont'><div style='width:".(count($photoCl->idPhotos)*106+60)."px;height:78px;'><ul id='templ'>".$photoCl->litPhotos."</ul></div></div><br><div class='bigImgCont'></div>";
		}
	else //default start menu
		echo "<a href='?g=1'>редактор галереи</a><br>
		<a href='t=1'>просмотр галереи</a><br>
		<a href='#' class='exitB'>выход</a>";
	}
else echo $autorise;
?>

</body>
<html>
