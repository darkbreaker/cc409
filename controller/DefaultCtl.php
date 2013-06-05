<?php
include_once('ModeloCtl.php');
	class DefaultCtl extends ModeloCtl{
		function ejecutar(){
		if(@session_start() == false){session_destroy();session_start();}
			$this->mostrar(file_get_contents('view/Index.html'));		
		}

	}

?>