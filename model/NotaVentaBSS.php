<?php
	include_once('Conexion.php');
	include_once('NotaVenta.php');
  class NotaVentaBSS{
		public $total;
		public $fecha;
		public $id;		
		
		function listar(){
			$conexion= new Conexion (  );
			if($conexion->conecta()==false){
				$conexion->cerrar();
				die('error al conectar');
				}
		
			//ejecutar el query
			$resultado = $conexion->consulta('select * from NotaVenta');	
			if($resultado==FALSE){
				die('error de resultado');
				$conexion->cerrar();
				return FALSE;
				}
				
			for ($i=0;$i<count($resultado);$i++) 
                              { 
		$obj[$i] = new NotaVenta($resultado[$i][total],$resultado[$i][fecha],$resultado[$i][id]); 
				}
				
			$conexion-> cerrar();
			return $resultado;
		}

	}
?>
