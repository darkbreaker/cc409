<?php
/**
 *@package veterinariaweb
 //index principal
 */
 include('controller/UsuarioCtl.php');
 include('controller/CitaCtl.php');
 include('controller/NotaVentaCtl.php');
 include('controller/PedidoCtl.php');
 include('controller/ServicioCtl.php');
 include('controller/ArticuloCtl.php');
 include('controller/LoginCtl.php');
 
 switch($_REQUEST['accion']){
	case 'usuario':
		$controlador = new UsuarioCtl();
		break;
	case 'cita':
		$controlador = new CitaCtl();
	break;
	case 'notaVenta':
		$controlador = new NotaVentaCtl();
	break;
	case 'pedido':
		$controlador = new PedidoCtl();
	break;
	case 'servicio':
		$controlador = new ServicioCtl();
	break;
	case 'articulo':
		$controlador = new ArticuloCtl();
	break;
	case 'login':
		$controlador = new LoginCtl();
 
 }

 $controlador->ejecutar();




?>