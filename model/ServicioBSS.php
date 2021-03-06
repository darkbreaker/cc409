<?php
	include_once('Conexion.php');
include_once('Servicio.php');
  class ServicioBSS{
		function buscarServicio($id){
		$con= new Conexion (  );
		$id=$con->escapar($id);
		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT * FROM servicio WHERE id= '$id'";
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
		$id=$con->escapar($id);
		$con= new Conexion (  );
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
		$conexion= new Conexion (  );
		if($conexion->conecta()==false){
			$conexion->cerrar();
			die('error al conectar');
			}
	
		//ejecutar el query
		$resultado = $conexion->consulta('select * from servicio');	
		if($resultado===false){
			die('error de resultado');
			$conexion->cerrar();
			return FALSE;
			}
			
		$conexion-> cerrar();

			while($row = $resultado->fetch_array(MYSQLI_ASSOC))	{
		$obj[] = $row;		}					
			return $obj;
	}
		
	function agregar($precio,$tiempo,$descripcion){
	
		
		//conectarse a la base de datos
		$con= new Conexion (  );
	

		
		if(!$con->conecta())
			die('error conexion');
		//crear el query
		$precio=$con->escapar($precio);
		$tiempo=$con->escapar($tiempo);
		$descripcion=$con->escapar($descripcion);
		
		//asignar variables al objeto
		$this -> tiempo = $tiempo;
		$this -> descripcion = $descripcion;
		$this -> precio = $precio;
		$sql="INSERT INTO servicio(tiempo,descripcion,precio) VALUES ('$this->tiempo','$this->descripcion','$this->precio') ";
		//$sql=$con->escapar($sql);
		//ejecutar el query
		$resultado=$con->consulta($sql);
		if($resultado===false){
			die('error insercion');
			$con->cerrar();
			return FALSE;
			}
		$this -> id =$resultado;
		$con->cerrar();
		return $this->id;
	}
		
	}
?>
