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
        
		function agregarCita($idUsuario, $fecha, $detalles, $hora_reserva){
			
			//conectarse a la base de datos
			$con= new Conexion (  );
			$idUsuario=$con->escapar($idUsuario);
			$fecha=$con->escapar($fecha);
			$detalles=$con->escapar($detalles);
			$hora_reserva=$con->escapar($hora_reserva);
			
			$this -> fecha=$fecha;
			$this -> cliente=$idUsuario;
			$this -> detalles=$detalle;
			$this -> hora_reserva=$hora_reserva;				
        
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
		
        function buscarCita($idCita){
			$con= new Conexion (  );
			$idCita=$con->escapar($idCita);
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
			return false;
         }
		 
         function eliminarCita($idCita){
			$con= new Conexion (  );
			$idCita=$con->escapar($idCita);
			if($con->conecta()==false)
				die('error de conexion');
			$sql='DELETE FROM cita WHERE id= '.$id;
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
        function SerciviosCita($idCita){
			$con= new Conexion (  );
			$idCita=$con->escapar($idCita);
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
        function ActualizarCita($idCita, $hora_termino,$estado){
			$con= new Conexion (  );
			$idCita=$con->escapar($idCita);
			$hora_termino=$con->escapar($hora_termino);
			$estado=$con->escapar($estado);
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
		}
			
       function filtrarCita($descripcion){
		$con= new Conexion (  );
		$descripcion=$con->escapar($descripcion);
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
		 
		 
         function listar(){
			$conexion= new Conexion (  );
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
				
			for ($i=0;$i<count($resultado);$i++) 
                              { 
		$obj[$i] = new Cita($resultado[$i][id],$resultado[$i][fecha],$resultado[$i][cliente],$resultado[$i][estado],$resultado[$i][detalles],$resultado[$i][hora_reserva],$resultado[$i][hora_termino]); 
				}
				
			$conexion-> cerrar();
			return $resultado;
         }
			

	}
?>
