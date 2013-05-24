<?php
	include_once('Conexion.php');
	include_once('Usuario.php');
  class UsuarioBSS{
		public $id;
		public $nombre;
		public $telefono;
		public $direccion;
		public $password;
		public $tipo;
		public $email;

			
		//metodos
		/**@param String $nombre
		*@param string mail
		*@param string $pass encriptado md5
		*@param string $calle indica la direccion 
		*@param string telefono 
		*@return mixed regresa $int con el id en caso de falle un false
		*/

	function agregarUsuario($nombre,$mail,$pass,$calle,$telefono){
		//conectarse a la base de datos
		$con= new Conexion (  );
		
			if(!$con->conecta())
			die('error conexion');
			
		$nombre=$con->escapar($nombre);
		$mail=$con->escapar($mail);
		$pass=$con->escapar($pass);
		$calle=$con->escapar($calle);
		$telefono=$con->escapar($telefono);
		$this->nombre=$nombre;
		$this->mail=$mail;
		$this->calle=$calle;
		$this->pass=$pass;
		$this->telefono=$telefono;
		
		//crear el query
		$sql="INSERT INTO usuario(nombre,calle,password,email,telefono,privilegios) VALUES ('$this->nombre','$this->calle','$this->pass','$this->mail','$this->telefono',DEFAULT) ";
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

	/**
	*@return mixed objeto de clase usuario si lo encuentra o FALSE si hay un error
	*/
	function buscarUsuario($id){
		$con= new Conexion ( );

		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT * FROM usuario WHERE idPersona= '$id'";
		//ejecutar el query
		$fila = $con->consulta($sql);	
		if($fila==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}

		$fila = $fila->fetch_array(MYSQLI_ASSOC);
			$con->cerrar();
			//$clase= new Usuario ($fila[idPersona],$fila[nombre],$fila[telefono],$fila[calle],$fila[password],$fila[privilegios],$id);
			
			return $fila;

	}
	
	
	function login($id,$pass){
			$con= new Conexion (  );
			
			if($con->conecta()==false)
				die('error de conexion');
			$id=$con->escapar($id);
			$pass=$con->escapar($pass);
			$sql="SELECT * FROM usuario WHERE email='$id' and password=".$pass;
			//ejecutar el query
			$fila = $con->consulta($sql);	
			if($fila==false){
				die('error al consultar login');
				$con->cerrar();
				return FALSE;
				}
			$fila = $fila->fetch_array(MYSQLI_ASSOC);
			$con->cerrar();
			$clase= new Usuario ($fila[idPersona],$fila[nombre],$fila[telefono],$fila[calle],$fila[password],$fila[privilegios],$id);
			return $clase;


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
		$resultado = $conexion->consulta('SELECT * FROM usuario');	
		if($resultado==FALSE){
			die('error de resultado');
			$conexion->cerrar();
			return FALSE;
			}
		
		for ($i=0;$i<count($resultado);$i++) 
                              { 
	$obj[$i] = new Usuario($resultado[$i][id],$resultado[$i][nombre],$resultado[$i][telefono],$resultado[$i][direccion],$resultado[$i][password],$resultado[$i][tipo],$resultado[$i][email]); 
			}	
			
		$conexion-> cerrar();
		return $resultado;
	}
	
	function filtrarUsuario($descripcion){
		$con= new Conexion (  );
		$descripcion=$con->escapar($descripcion);
		if($con->conecta()==false)
			die('error de conexion');
		$sql="SELECT * FROM usuario WHERE CONCAT(nombre,calle,telefono) LIKE '%".$descripcion."%'";
		//ejecutar el query
		$resultado = $con->consulta($sql);	
		if($resultado==false){
			die('error al consultar');
			$con->cerrar();
			return FALSE;
			}

		for ($i=0;$i<count($resultado);$i++) 
                              { 
	$obj[$i] = new Usuario($resultado[$i][id],$resultado[$i][nombre],$resultado[$i][telefono],$resultado[$i][direccion],$resultado[$i][password],$resultado[$i][tipo],$resultado[$i][email]); 
			}	
			
		return $obj;

	}
	
		function modificar($nombre,$telefono,$direccion,$password,$email,$idUsuario){
	
		//conectarse a la base de datos
		$con= new Conexion ();
		
		
		if(!$con->conecta())
			die('error conexion');
		//crear el query
		$sql="UPDATE usuario SET email='$email', nombre='$nombre' , telefono='$telefono' , calle ='$direccion',password='$password'  WHERE idPersona=".$idUsuario;
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
		
		
	}
?>
