var adminFunc={
	verifMe: function()
		{
		$.ajax({dataType:'script',url:'verifMe.php?'+(($(this).hasClass('exitB'))?('e=1'):('l='+$('.log').val()+'&p='+$('.pas').val()))+'&'+sn+'='+si});
		},
	showBImg: function()
		{
		var r=$(this).attr('alt');
		globId=idPh[r];
		var newImg=" <a href='#' class='delObj'><div></div>Удалить объект</a><div id='myNicPanel'></div><br><span id='mytitle' style=''>"+titlePh[r]+"</span><br><img src='"+$(this).attr('src')+"'><br><span id='mydesc'>"+descPh[r]+"</span>";
		$('.bigImgCont').html(newImg);
		
		var myNicEditor=new nicEditor({onSave:function(content,id,instance){$.ajax({dataType:'script',url:'saveText.php?w='+id+'&t='+content+'&ph=1&nph='+globId+'&r='+r+'&'+sn+'='+si});}});
		myNicEditor.setPanel('myNicPanel');
		myNicEditor.addInstance('mytitle');
		myNicEditor.addInstance('mydesc');
		
		$('#editor').html(descPh[r]);
		$('.delObj').on('click',{atx: "вы уверены?<br><input type='button' value='да,удалить' class='delYes'><input type='button' value='нет, отмена' class='delNo'>" },adminFunc.showAsk);
		},
	showBImgView: function()
		{
		var r=$(this).attr('alt');
		globId=idPh[r];
		var newImg="<span id='mytitle' style=''>"+titlePh[r]+"</span><br><img src='"+$(this).attr('src')+"'><br><span id='mydesc'>"+descPh[r]+"</span>";
		$('.bigImgCont').html(newImg);
		},
	newImg: function()
		{
		var lImg=window.open('loadFileWindow.php','loadImg','width=400,height=300');
		},
	delImg: function()
		{
		$.ajax({dataType:'script',url:'sortSave.php?del=1&numP='+globId+'&'+sn+'='+si});
		$('.asker').hide();
		},
	showAsk: function(ev)
		{
		$('.asker').css({'width':'200px','height':'80px','left':(ev.pageX-100),'top':(ev.pageY+15)});
		$('.asker').html(ev.data['atx']);
		$('.asker').show();
		$('.delYes').click(adminFunc.delImg);
		$('.delNo').click(function(){$('.asker').hide();});
		}
	}
