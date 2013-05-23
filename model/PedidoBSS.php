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
		$resultado = $conexion->consulta('select * from pedido');	
		if($resultado==FALSE){
			die('error de resultado');
			$conexion->cerrar();
			return FALSE;
			}
			
			for ($i=0;$i<count($resultado);$i++) 
                              { 
		$obj[$i] = new Pedido($resultado[$i][idArticulo],$resultado[$i][fidUsuario],$resultado[$i][fechaReservacion],$resultado[$i][cliente]); 
				}
			
		$conexion-> cerrar();
		return $resultado;
	}
		
		function buscarReservacion($idUsuario){
		$con= new Conexion (  );
		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT * FROM usuario WHERE idPersona='$idUsuario'";
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}
			/*
		if($fila[0][idPersona]==$id){
		$con->cerrar();
		$clase= new Usuario ($fila[0][idPersona],$fila[0][nombre],$fila[0][telefono],$fila[0][calle],$fila[0][password],$fila[0][privilegios],$fila[0][email]);

		return $clase;
		}	*/
		return $fila;

	}
		
		function ActualizarReservacion($idReservacion,$estado){
	
		//conectarse a la base de datos
		$con= new Conexion (  );
		if(!$con->conecta())
			die('error conexion'.$conexion->errno);
		//crear el query
		$sql="UPDATE usuario SET estado='$estado'   WHERE idpedido=".$idReservacion;
		//$sql=$con->escapar($sql);
		//ejecutar el query
		$resultado=$con->consulta($sql);
		if($resultado==false){
			die('error actualizar');
			$con->cerrar();
			return FALSE;
			}

		return $resultado;
	}
	


		function agregar($idproducto,$idpersona){
	
		//conectarse a la base de datos
		$con= new Conexion (  );
		if(!$con->conecta())
			die('error conexion'.$conexion->errno);
		//crear el query
		$sql="INSERT INTO pedido(fecha,estado,idarticulo,idPersona) VALUES (now(),'P','$idproducto','$idpersona') ";
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
