<?php
//controlador requiere tener acceso al modelo
include_once('model/NotaVentaBss.php');
	class StdCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo NotaVenta
		function __construct(){
			$this->modelo = new NotaVentaBss();
		}

		function ejecutar(){
			
			if(isset($_REQUEST['accion']) ){
				$NotaVenta = $this->modelo-> listar();
			
				include('view/NotaVentaView.php');
			}
			
		}

	}




?>