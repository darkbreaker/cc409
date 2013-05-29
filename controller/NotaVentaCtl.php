<?php
//controlador requiere tener acceso al modelo
include_once('model/NotaVentaBSS.php');
include_once('ModeloCtl.php');
	class NotaVentaCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo NotaVenta
		function __construct(){
			$this->modelo = new NotaVentaBSS();
		}

		function ejecutar(){
				 
				
				if(isset($_SESSION['usuario'])){
				
					if($_SESSION['privilegio']==2){
					$NotaVenta = $this->modelo-> listar();
					include('view/NotaVentaView.php');
					}else{//no se tienen privilegios sufuicientes
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
					}
				}else	// si no hay sesion envia al menu principal
					$file = file_get_contents('view/Index.html'); $file = str_ireplace('{Username}','sin sesion',$file); echo $file;
		}

	}




?>
