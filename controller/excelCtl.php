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
	$i=1;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,"nombre");
		$objPHPExcel->getActiveSheet()->SetCellValue("C".$i,"precio");
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i,"descripcion");
	foreach($arreglo as $row ){
		$i++;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$row["nombre"]);
		$objPHPExcel->getActiveSheet()->SetCellValue("C".$i, $row["precio"]);
		$objPHPExcel->getActiveSheet()->setCellValue("D".$i, $row["descripcion"]);
		//$objPHPExcel->getActiveSheet()->setCellValue("E".$row["id_cli"], $row["telefono_cli"]);
		//$objPHPExcel->getActiveSheet()->setCellValue("F".$row["id_cli"], $row["pais_cli"]);
		
	}

	//Titulo del libro y seguridad 
	$objPHPExcel->getActiveSheet()->setTitle('Reporte');
	 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="your_name.xls"');
header('Cache-Control: max-age=0');
	//Creamos el Archivo .xlsx
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	$objWriter->save('php://output');
	}

}
?>