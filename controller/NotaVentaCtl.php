<?php
//controlador requiere tener acceso al modelo
include_once('model/NotaVentaBss.php');
include_once('ModeloCtl.php');
	class NotaVentaCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo NotaVenta
		function __construct(){
			$this->modelo = new NotaVentaBss();
		}

		function ejecutar(){
				session_start();
				
				if(isset($_SESSION['usuario'])){
				
					if($_SESSION['privilegio']==2){
					$NotaVenta = $this->modelo-> listar();
					include('view/NotaVentaView.php');
					}else{//no se tienen privilegios sufuicientes
						include('view/View.php');
					}
				}else{// si no hay sesion envia al menu principal
					include('view/View.php');
					
					}
		}

	}




?>
