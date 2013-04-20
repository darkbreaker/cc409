<?php
/**
 *@package veterinariaweb
 //index principal
 */
 switch($_REQUEST['accion']){
	case 'usuario':
		include('controller/UsuarioCtl.php');
		$controlador = new UsuarioCtl();
		break;
	case 'cita':
		include('controller/CitaCtl.php');
		$controlador = new CitaCtl();
	        break;
	case 'notaVenta':
		include('controller/NotaVentaCtl.php');
		$controlador = new NotaVentaCtl();
           	break;
	case 'pedido':
		include('controller/PedidoCtl.php');
		$controlador = new PedidoCtl();
        	break;
	case 'servicio':
		include('controller/ServicioCtl.php');
		$controlador = new ServicioCtl();
	        break;
	case 'articulo':
	        include('controller/ArticuloCtl.php');
		$controlador = new ArticuloCtl();
		break;
	case 'log':
		include('controller/LogCtl.php');
		$controlador = new LogCtl();
		break;
	default:
		include('controller/DefaultCtl.php');
		$controlador = new LogCtl();
 }

 $controlador->ejecutar();




?>
