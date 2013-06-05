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
			if(@session_start() == false){session_destroy();session_start();}
				 
				if(isset($_SESSION['usuario'])){
				
					if($_SESSION['privilegio']==2){
					$NotaVenta = $this->modelo-> listar();
					include('view/Index.html');
					}else{
						$file = file_get_contents('view/Index.html'); $file = str_ireplace('>{Username}<','><',$file); echo $file;
					}
				}else{	
					$file = file_get_contents('view/Index.html');
					$file = str_ireplace('>{Username}<','><',$file);
					echo $file;}
		}

	}


?>