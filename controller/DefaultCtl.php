<?php
include_once('ModeloCtl.php');
	class DefaultCtl extends ModeloCtl{
		function ejecutar(){
		session_start();
			$this->mostrar(file_get_contents('view/Index.html'));		
		}

	}


?>
