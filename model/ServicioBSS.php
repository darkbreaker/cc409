<?php
	include_once('Conexion.php');
include_once('Servicio.php');
  class ServicioBSS{
		function buscarServicio($id){
		$con= new Conexion ('localhost', 'root', 'root','cc409_perros');
		if($con->conecta()==false)
			die('error de conexion');
		$sql='SELECT * FROM servicio WHERE id= '.$id;
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}
			
		if($fila[0][id]==$id){
			$con->cerrar();
			$clase= new Servicio ($fila[0][id],$fila[0][tiempo],$fila[0][descripcion],$fila[0][precio]);
		}
		return $clase;
		}	
		
		function eliminar($id){
		$con= new Conexion ('localhost', 'root', 'root','cc409_perros');
		if($con->conecta()==false)
			die('error de conexion');
		$sql='DELETE FROM servicio WHERE id= '.$id;
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

	
	
		/**
	*@return mixed array o FALSE si hay un error
	*/
	function listar(){
		$conexion= new Conexion ('localhost', 'root', 'root','cc409_perros');
		if($conexion->conecta()==false){
			$conexion->cerrar();
			die('error al conectar');
			}
	
		//ejecutar el query
		$resultado = $conexion->consulta('select * from servicio');	
		if($resultado==FALSE){
			die('error de resultado');
			$conexion->cerrar();
			return FALSE;
			}
		$conexion-> cerrar();
		return $resultado;
	}
		
	function agregar($precio,$tiempo,$descripcion){
		//asignar variables al objeto
		$this -> tiempo = $tiempo;
		$this -> descripcion = $decripcion;
		$this -> precio = $precio;

		
		//conectarse a la base de datos
		$con= new Conexion ('localhost', 'root', 'root','cc409_perros');
		if(!$con->conecta())
			die('error conexion');
		//crear el query
		$sql="INSERT INTO servicio(tiempo,descripcion,precio) VALUES ('$this->tiempo','$this->precio','$this->descripcion') ";
		//$sql=$con->escapar($sql);
		//ejecutar el query
		$resultado=$con->consulta($sql);
		if($resultado==false){
			die('error insercion');
			$con->cerrar();
			return FALSE;
			}
		$this -> id =$resultado;
		$con->cerrar();
		return $this->id;
	}
		
		function filtrarUsuario($descripcion){
		$con= new Conexion ('localhost', 'root', 'root','cc409_perros');
		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT * FROM usuario WHERE CONCAT(tiempo,precio,descripcion) LIKE '%".$descripcion."%'";
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}
		
		return $fila;
		}
	}
?>
