<?php
	include_once('Conexion.php');
include_once('Pedido.php');
  class PedidoBSS{
  	public $idReservacion;
		public $idArticulo;
		public $idUsuario;
		public $fechaReservacion;
		public $estado;
		
		function listar(){
			$conexion= new Conexion (  );
			if($conexion->conecta()==false){
				$conexion->cerrar();
				die('error al conectar');
				}
		
			//ejecutar el query
			$resultado = $conexion->consulta("select idpedido as pedido,idarticulo as articulo,fecha,idcliente as cliente from pedido");	
			if($resultado==FALSE){
				die('error de resultado');
				$conexion->cerrar();
				return FALSE;
				}
				$conexion-> cerrar();
			while($row = $resultado->fetch_array(MYSQLI_ASSOC))		{
		$obj[] = $row;		}		
			return $obj;
				
			
		}
		
		function buscarReservacion($id){
			$conexion= new Conexion (  );
			if($conexion->conecta()==false){
				$conexion->cerrar();
				die('error al conectar');
				}
		
			//ejecutar el query
			$resultado = $conexion->consulta("select fecha,estado,idarticulo from pedido WHERE idcliente = '$id'");	
			if($resultado==FALSE){
				die('error de resultado');
				$conexion->cerrar();
				return FALSE;
				}
				$conexion-> cerrar();
			while($row = $resultado->fetch_array(MYSQLI_ASSOC))		{
		$obj[] = $row;		}		
			return $obj;

		}
		
		function ActualizarReservacion($id){
	

			$con= new Conexion (  );
			if(!$con->conecta())
				die('error conexion'.$conexion->errno);
			//crear el query
			$sql="UPDATE pedido SET estado =  'listo' WHERE idpedido ='$id'";
			$resultado=$con->consulta($sql);
			if($resultado===false){
				die('error actualizar');
				$con->cerrar();
				return FALSE;
				}

			return true;
	}
	


		function agregar($idproducto,$idpersona){
	
		//conectarse a la base de datos
		$con= new Conexion (  );
		if(!$con->conecta())
			die('error conexion'.$conexion->errno);
		//crear el query
		$sql="INSERT INTO pedido(fecha,estado,idarticulo,idcliente) VALUES (now(),'P','$idproducto','$idpersona') ";
		//ejecutar el query
		$resultado=$con->consulta($sql);
		if($resultado==false){
			die('error actualizar');
			$con->cerrar();
			return FALSE;
			}

		return true;
	}
	
	function eliminar($id){
		$con= new Conexion (  );
		if($con->conecta()==false)
			die('error de conexion');
		$sql='DELETE FROM pedido WHERE idpedido= '.$id;
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}
			
		$con->cerrar();
		return TRUE;
		}
		
		
	}
?>
