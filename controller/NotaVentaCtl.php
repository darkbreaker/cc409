<?php
//controlador requiere tener acceso al modelo
include_once('model/NotaVentaBss.php');
	class NotaVentaCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo NotaVenta
		function __construct(){
			$this->modelo = new NotaVentaBss();
		}

		function ejecutar(){
			
			
				$NotaVenta = $this->modelo-> listar();
				include('view/NotaVentaView.php');
			
			
		}

	}




?>
