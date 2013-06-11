<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBSS.php');
include_once('ModeloCtl.php');
include("PHPMailer/class.phpmailer.php");
include("PHPMailer/class.smtp.php"); 
define('GUSER', 'admvetmas@gmail.com'); // GMail username
define('GPWD', 'A1V2M3;@'); // GMail password

	class UsuarioCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Usuario
		function __construct(){
			$this->modelo = new UsuarioBSS();
		}

			function smtpmailer($to) { 
			global $error;
			$mail = new PHPMailer();  // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true;  // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465; 
			$mail->Username = GUSER;  
			$mail->Password = GPWD;
			$mail->Subject = "Bienvenido";
			$mail->SetFrom('admvetmas@gmail.com', 'VeteWebmaster');
			$mail->AddReplyTo("al_xsnake@hotmail.com","First Last");
			$body =file_get_contents('view/correo.html');
			$mail->Body=$body;
			$mail->IsHTML(true);	
			$mail->AddAddress($to);
			
			if(!$mail->Send()) {
				$error = 'Mail error: '.$mail->ErrorInfo; 
				return false;
			} else {
				$error = 'Message sent!';
				return true;
			}
		}
		function ejecutar(){ if(@session_start() == false){session_destroy();session_start();}
			
			if(!isset($_REQUEST['hacer'])){
				if(!isset($_SESSION['usuario'])){
					$this->mostrar(file_get_contents('view/Registro.html'));
					}
				else{
					$this->mostrar(file_get_contents('view/Modificar.html'));
					}
			}
			else	
			switch($_REQUEST['hacer']){
				case 'agregarUsuario':
					$nombre=$this->EsNombre($_REQUEST['nombre']);
					$email=$this->EsMail($_REQUEST['email']);
					$password=$_REQUEST['password'];
					$calle=$this->EsCalle($_REQUEST['calle']);
					$telefono=$this->EsTelefono($_REQUEST['telefono']);
					if(!$nombre||!$telefono||!$calle||!$email){
						$this->mostrar(file_get_contents('view/Index.html'));
					}else if(!isset($_SESSION['usuario'])){
							$Usuario=$this->modelo->agregarUsuario($nombre, $email, $password, $calle, $telefono);
							$this->mostrar(file_get_contents('view/Login.html'));
					}					
					$this->smtpmailer($email);
					break;
					
				case 'buscarUsuario':
					if(isset($_SESSION['usuario'])){
						$Usuario=$this->modelo->buscarUsuario($_SESSION['usuario']);
						echo json_encode($Usuario);
					}
	
					break;
				case 'filtro':
						if(isset($_SESSION['usuario'])){

										$Usuario=$this->modelo->filtrarUsuario($_REQUEST['descripcion']);
										echo json_encode($Usuario);

						}
					break;			
				case 'modificar':
					if(isset($_SESSION['usuario'])){
							$nombre=$this->EsNombre($_REQUEST['nombre']);
							$email=$this->EsMail($_REQUEST['email']);
							$password=$_REQUEST['password'];
							$calle=$this->EsCalle($_REQUEST['calle']);
							$telefono=$this->EsTelefono($_REQUEST['telefono']);
							if(!$nombre||!$telefono||!$calle||!$mail){
								$this->mostrar(file_get_contents('view/Index.html'));
							}else{
									$Usuario=$this->modelo->modificar($nombre, $telefono, $calle, $password, $mail, $_SESSION['usuario']) ;
									$file = file_get_contents('view/Index.html'); //cargo el archivo
									$file = str_ireplace('>Hola<','>Cambios hechos<' , $file); 
									$this->mostrar($file);
									echo $file;
							} 
					}else
						$this->mostrar(file_get_contents('view/Login.html'));
					break;
				case 'listar':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']!=0){
							$Usuario=$this->modelo->listar() ;
							echo json_encode($Usuario);
						}
						else
						$this->mostrar(file_get_contents('view/Index.html'));
					}
					break;
				case 'perfil':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']==0){
							$this->mostrar(file_get_contents('view/PerfilUsuario.html'));
						}else
							{
							$this->mostrar(file_get_contents('view/PerfilAdmin.html'));
							
							}
					}
					else{
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('<h5>Hola</h5>','Requiere Iniciar sesion',$file);
						$this->mostrar($file);
					}
					break;
				case 'agenda':
					if(isset($_SESSION['usuario'])){
						if($_SESSION['privilegio']!=0)
							$this->mostrar(file_get_contents('view/Agenda.html'));
						else
							$this->mostrar(file_get_contents('view/Index.html'));
					}else{
						$file = file_get_contents('view/Index.html');
						$file = str_ireplace('<h5>Hola</h5>','no no no',$file);
						$this->mostrar($file);
						}
					break;
				default:
					$this->mostrar(file_get_contents('view/Index.html'));
			} //fin del switch
			
		} //fin de la funcion

		
		
	}	//fin de la clase


?>