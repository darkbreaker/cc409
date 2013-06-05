<?php
require('fpdf17/fpdf.php');
class PDF extends FPDF
{
function LoadData($file)
{
    // Leer las líneas del fichero
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
// Tabla simple
function BasicTable($header, $data)
{
    // Cabecera
	$i=0;
    foreach($header as $col){
	
		if($i==0)
        $this->Cell(20,7,$col,1);
		else
		$this->Cell(50,7,$col,1);
		$i++;
		}
    $this->Ln();
    // Datos
    foreach($data as $row)
    {
		$i=0;
        foreach($row as $col){
            if($i==0)
        $this->Cell(20,7,$col,1);
		else
		$this->Cell(50,7,$col,1);
		$i++;
		}
        $this->Ln();
    }
}

	function run($datos){
		$pdf = new PDF();
		// Títulos de las columnas
		$header = array('ID ', 'articulo', 'descripcion', 'precio');
		//Carga de datos
		//$data = $pdf->LoadData($datos);
		$pdf->SetFont('Arial','',14);
		$pdf->AddPage();
		$pdf->BasicTable($header,$datos);
		@$pdf->Output();
	//	@$pdf->Output('catalogo.pdf','F');
		/*$mi_pdf = 'catalogo.pdf';
					header('Content-type: application/pdf'); 
					header('Content-Disposition: attachment; filename="'.$mi_pdf.'"'); 
					readfile($mi_pdf);*/
	}
}
?>