<?php
include_once('Conexion.php');
include_once('Cita.php');
  class CitaBSS{
		public $id;
		public $fecha;
		public $cliente;
		public $estado;
		public $detalles;
		public $hora_reserva;		
		public $hora_termino;		
        
		agregarCita($idUsuario, $fecha, $detalles, $hora_reserva){
			$this -> fecha=$fecha;
			$this -> cliente=$idUsuario;
			$this -> detalles=$detalle;
			$this -> hora_reserva=$hora_reserva;				
        
			
			//conectarse a la base de datos
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if(!$con->conecta())
				die('error conexion');
			//crear el query
			$sql="INSERT INTO cita(idPersona,fecha,detalles,inicio) VALUES ('$this->idUsuario','$this->fecha','$this->detalles','$this->hora_reserva') ";
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
         buscarCita($idCita){
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if($con->conecta()==false)
				die('error de conexion');
			$sql='SELECT * FROM cita WHERE id= '.$id;
			//ejecutar el query
			$fila = $con->consulta($sql);	
			if($fila==false){
				die('error al consultar');
				$con->cerrar();
				return FALSE;
				}
				
			if($fila[0][id]==$id){
			$con->cerrar();
			$clase= new Cita ($fila[0][id],$fila[0][fecha],$fila[0][idPersona],$fila[0][estado],$fila[0][detalles],$fila[0][inicio],$fila[0][fin]);

			return $clase;
		 
         }
         eliminarCita($idCita){
			
		 
         }
         SerciviosCita($idCita){
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if($con->conecta()==false)
				die('error de conexion');
			$sql='SELECT descripcion FROM detalle_cita as D,cita AS C,servicio as S WHERE D.idservicio=S.idServicio and D.idcita=C.idPersona and  C.id= '.$id;
			//ejecutar el query
			$fila = $con->consulta($sql);	
			if($fila==false){
				die('error al consultar');
				$con->cerrar();
				return FALSE;
				}
			
			return $fila;
         }
         ActualizarCita($idCita, $hora_termino,$estado){
			$con= new Conexion ('localhost', 'root', 'root','maskota');
			if(!$con->conecta())
				die('error conexion'.$conexion->errno);
		//crear el query
			$sql="UPDATE usuario SET fin='$hora_termino', estado='$estado'  WHERE idCita=".$idCita;
			//$sql=$con->escapar($sql);
			//ejecutar el query
			$resultado=$con->consulta($sql);
			if($resultado==false){
				die('error actualizar');
				$con->cerrar();
				return FALSE;
				}

			return $resultado;
			
       filtrarCita($descripcion){
		$con= new Conexion ('localhost', 'root', 'root','maskota');
		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT * FROM usuario WHERE CONCAT(fecha,detalles,hora_reserva) LIKE '%".$descripcion."%'";
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}
         }
         listar(){
			$conexion= new Conexion ('localhost', 'root', 'root','maskota');
			if($conexion->conecta()==false){
				$conexion->cerrar();
				die('error al conectar');
				}
		
			//ejecutar el query
			$resultado = $conexion->consulta('select * from citas');	
			if($resultado==FALSE){
				die('error de resultado');
				$conexion->cerrar();
				return FALSE;
				}
			$conexion-> cerrar();
			return $resultado;
         }
			



	}
?>
