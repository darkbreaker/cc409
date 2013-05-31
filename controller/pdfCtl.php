<?php
require('fpdf.php');

class PDF extends FPDF
{


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

// Una tabla más completa
function ImprovedTable($header, $data)
{
    // Anchuras de las columnas
    $w = array(40, 35, 45, 40);
    // Cabeceras
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Datos
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}

// Tabla coloreada
function FancyTable($header, $data)
{
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(40, 35, 45, 40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}

	function run($datos){
		$pdf = new PDF();
		// Títulos de las columnas
		$header = array('id', 'articulo', 'descripcion', 'precio');
		//Carga de datos
		//$data = $pdf->LoadData($datos);
		$pdf->SetFont('Arial','',14);
		$pdf->AddPage();
		$pdf->BasicTable($header,$datos);
		
		$pdf->Output();
	}
}
?>