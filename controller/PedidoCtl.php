<?php
//controlador requiere tener acceso al modelo
include_once('model/PedidoBSS.php');
include_once('ModeloCtl.php');
	class PedidoCtl extends ModeloCtl{
		public $modelo;
		
		//cuando se crea el contrador crea el modelo Pedido
		function __construct(){
		
			$this->modelo = new PedidoBSS();
		}
		
		
		function ejecutar(){ 
			if(@session_start() == false){session_destroy();session_start();} 
			if(isset($_SESSION['usuario'])){
				if(!isset($_REQUEST['hacer'])){
					$this->mostrar(file_get_contents('view/Pedidos.html'));
					
				}else
				switch($_REQUEST['hacer']){
					case 'agregar':		
						$Pedido=$this->modelo->agregar($_REQUEST['id'],$_SESSION['usuario']);
						$file = str_ireplace('<h5>Hola</h5>','Pedido hecho',file_get_contents('view/Index.html'));
						$this->mostrar($file);
						break;
						
					case 'listar':
							$Pedido=$this->modelo->listar();
							echo json_encode($Pedido);
							break;
					case 'buscar':
							
					$Pedido=$this->modelo->buscarReservacion($_SESSION['usuario']);
					echo json_encode($Pedido);	
					break;
							
					case 'eliminarReservacion':
							$idReservacion=$this->EsId($_REQUEST['idReservacion']);

								if($idReservacion!=false&&$_SESSION['privilegio']>0){
									$Pedido=$this->modelo->eliminarReservacion($idReservacion);
									$file = str_ireplace('<h5>Hola</h5>','hecho',file_get_contents('view/Index.html')); 
									$this->mostrar($file);
									}
							else{
									$file = str_ireplace('<h5>Hola</h5>','Error',file_get_contents('view/Index.html')); 
									$this->mostrar($file);
								}
								break;
						case 'actualizar':
								$idReservacion=$this->EsId($_REQUEST['idReservacion']);
								if($idReservacion!=false){
									$Pedido=$this->modelo-> ActualizarReservacion($idReservacion);
									$file = str_ireplace('<h5>Hola</h5>','Reservacion actulizada',file_get_contents('view/Index.html')); 
									$this->mostrar($file);
								}else{
									$file = str_ireplace('<h5>Hola</h5>','Error',file_get_contents('view/Index.html')); 
									$this->mostrar($file);
									}
								break;
						Default:
							$file = str_ireplace('<h5>Hola</h5>','Error',file_get_contents('view/Index.html')); 
							$this->mostrar($file);
							
					}//fin del switch
				} 	
				else {
					$file = str_ireplace('<h5>Hola</h5>','Error',file_get_contents('view/Index.html')); 
					$this->mostrar($file);
					}
					
		}	//fin de funcion	
	}	// fin de clase



?>