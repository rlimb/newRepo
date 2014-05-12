<?php

class imageLoad
	{
	private $src;
	private $descr;
	private $title;
	private $width;
	private $height;
	private $mustWidth=1024;
	private $mustHeight=768;
	private $newSize=array();
	private $type;
	private $dbcnx;
	private $CreateImg;
	
	public $wasErr=false;

	function __construct($fileAr,$src,$descr,$title,$dbcnx)
		{
		$this->src=$src;
		$this->descr=$descr;
		$this->title=$title;
		$this->dbcnx=$dbcnx;
		
		
	
		$this->tryError($fileAr);

		if(!$this->wasErr)
			{
			$this->image_create($fileAr);
			$this->newSize=array($this->width,$this->height);
			$r=false;
			if($this->height>$this->mustHeight||$this->width>$this->mustWidth)$r=$this->defineNewSize();
			if($r)$this->imageResize();
			
			$this->save("img/galery/",100);
			}
		}
		
	private function tryError($fileAr)
		{
		if($fileAr['error']!=0)
			{
			switch($fileAr['error'])
				{
				case 1; case 2: $this->wasErr='Файл слишком большой<br>'; break;
				case 3: $this->wasErr='Попробуйте ещё раз<br>'; break;
				case 4: $this->wasErr='Укажите загружаемый файл<br>'; break;
				default: $this->wasErr='Технические ошибки при загузке файла<br>'; break;
				}
			}
		else
			if(!$this->whatAType($fileAr))$this->wasErr='Файл не является изображением<br>';
			
		if(!$this->src)$this->wasErr.='Укажите имя файла<br>';
		if(!$this->descr)$this->wasErr.='Введите описание<br>';
		if(!$this->title)$this->wasErr.='Введите заголовок<br>';

		}
	
	
	
	private function whatAType($fileAr)
		{
		switch($fileAr['type'])
			{
			case 'image/jpeg':
			$this->type='jpg';
			return true;
			case 'image/gif':
			$this->type='gif';
			return true;
			case 'image/png':
			$this->type='png';
			return true;
			default:
			return false;
			}
		}

	private function image_create($fileAr)
		{
		switch($this->type)
			{
			case 'jpg':
			$this->CreateImg=@imagecreatefromJpeg($fileAr['tmp_name']);
			break;
			case 'gif':
			$this->CreateImg=@imagecreatefromGif($fileAr['tmp_name']);
			break;
			case 'png':
			$this->CreateImg=@imagecreatefromPng($fileAr['tmp_name']);
			break;
			default:
			break;
			}
		if($this->CreateImg)
			{
			$this->width=imageSX($this->CreateImg);
			$this->height=imageSY($this->CreateImg);
			}
		}
	

	private function defineNewSize()
		{
		$r=false;
		if($this->height>$this->mustHeight)
			{
			$this->newSize[1]=$this->mustHeight;
			$this->newSize[0]=$this->width*$this->mustHeight/$this->height;
			$r=true;
			}
		if($this->newSize[0]>$this->mustWidth)
			{
			$this->newSize[0]=$this->mustWidth;
			$this->newSize[1]=$this->newSize[1]*$this->mustWidth/$this->newSize[0];
			$r=true;
			}
		return $r;
		}
	private function imageResize()
		{
		$resImage=imagecreatetruecolor($this->newSize[0],$this->newSize[1]);
		imagecopyresampled($resImage,$this->CreateImg,0,0,0,0,$this->newSize[0],$this->newSize[1],$this->width,$this->height);
		$this->CreateImg=$resImage;
		}

	private function save($dir,$q)
		{
		$allPath=$dir.basename($this->src).".".$this->type;
		
		switch($this->type)
			{
			case 'jpg':
			imagejpeg($this->CreateImg,$allPath,$q);
			break;
			case 'gif':
			imagegif($this->CreateImg,$allPath);
			break;
			case 'png':
			imagepng($this->CreateImg,$allPath);
			break;
			default:
			break;
			}
		$this->saveDb();
		}
	
	private function saveDb()
		{
		$res=mysql_fetch_array(mysql_query("SELECT MAX(`rang`) from `photo`",$this->dbcnx));

		mysql_query("INSERT INTO `photo` VALUES(NULL,'".$this->src.".".$this->type."','".$this->descr."','".$this->title."','".($res[0]+1)."','1');",$this->dbcnx) or die(mysql_error());
		echo "<h1>УСПЕШНО</h1><script>window.setTimeout('window.close();',1000);</script>";
		}
	}
?>