
function nuevoAjax(){
	var xmlhttp=false;
	try{
		//creacion del ajax para navegadores no IE
		xmlhttp=new ActiveXObject("Msxl2.XMLHTTP");
	}
	catch (e){
		try{
			//creacion ajax para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e){
			if(!xmlhttp && typeof XMLHttpRequest!='undefined')
			xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp;
}
