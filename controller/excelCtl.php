<?php
require_once("PHPExcel.php");
require_once("PHPExcel/Writer/Excel2007.php");

class Excel {

	function run ($arreglo){
	$objPHPExcel = new PHPExcel();

	$objPHPExcel->getProperties()->setCreator("autor");
	$objPHPExcel->getProperties()->setLastModifiedBy("autor");
	$objPHPExcel->getProperties()->setTitle("titulo del Excel");
	$objPHPExcel->getProperties()->setSubject("Asunto");
	$objPHPExcel->getProperties()->setDescription("Descripcion");
	$objPHPExcel->setActiveSheetIndex(0);

	//foreach($arreglo as $row ){
		$objPHPExcel->getActiveSheet()->SetCellValue('A1','value');
		//$objPHPExcel->getActiveSheet()->SetCellValue("C".$row["id_cli"], $row["nombre_cli"]);
		//$objPHPExcel->getActiveSheet()->setCellValue("D".$row["id_cli"], $row["correo_cli"]);
		//$objPHPExcel->getActiveSheet()->setCellValue("E".$row["id_cli"], $row["telefono_cli"]);
		//$objPHPExcel->getActiveSheet()->setCellValue("F".$row["id_cli"], $row["pais_cli"]);
//	}

	//Titulo del libro y seguridad 
	$objPHPExcel->getActiveSheet()->setTitle('Reporte');
	 

	//Creamos el Archivo .xlsx
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2003');
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	
	//$objWriter->save('php://output');
	}

}
?>