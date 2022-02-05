<?php
session_start();
/// Powered by Evilnapsis go to http://evilnapsis.com
include "fpdf/fpdf.php";

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);
// Agregamos los datos de la empresa
$pdf->Image('../img/logo.jpg',10,8,22);
// $pdf->Cell(5,$textypos,"PcTools");
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"PcTools.org");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Calle Castillo del mar /9");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"+34 757451273");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"PcTools@yopmail.com");

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(75);
$pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(75);
$pdf->Cell(5,$textypos, $_SESSION['usuario']);
$pdf->setY(40);$pdf->setX(75);
$pdf->Cell(5,$textypos,"Direccion del cliente");
$pdf->setY(45);$pdf->setX(75);
$pdf->Cell(5,$textypos,"Telefono del cliente");
$pdf->setY(50);$pdf->setX(75);
$pdf->Cell(5,$textypos,"Email del cliente");

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos,"FACTURA #12345");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Fecha: ".date("F j, Y, g:i a"));
$pdf->setY(40);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Vencimiento: 11/ENE/2020");
$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("Cod.", "nombre","Cantidad","Precio","Total");
//// Arrar de Productos
$products = Array();
// for($i=0;$i<=count($products);$i++){
    foreach($_SESSION['cesta'] as $codigo => $producto) {    
        $products=array($codigo,$producto['nombre'],$producto['cantidad'],$producto['precio'],0);
    }
// }
// }
// echo "<pre>";
// var_dump($products);
// echo "<pre>";
$w = array(30, 95, 15, 20, 25);
// Header
for($i=0;$i<count($header);$i++)
$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
$pdf->Ln();
// Data
$total = 0;
if(isset($_SESSION['cesta'])){
    foreach($_SESSION['cesta'] as $codigo => $producto)
    {
        $pdf->Cell($w[0],6,$codigo,1);
        $pdf->Cell($w[1],6,$producto['nombre'],1);
        $pdf->Cell($w[2],6,number_format($producto['cantidad']),'1',0,'R');
        $pdf->Cell($w[3],6,"$ ".number_format($producto['precio'],2),'1',0,'R');
        $pdf->Cell($w[4],6,"$ ".number_format($producto['precio']*$producto['cantidad'],2,".",","),'1',0,'R');

        $pdf->Ln();
        $total+=$producto['precio']*$producto['cantidad'];

    }
}
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 60 + (count($products)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
	array("Subtotal",$total),
	array("Descuento", 0),
	array("Impuesto", 0),
	array("Total", $total),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','B',10);    

$pdf->setY($yposdinamic);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic+10);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
$pdf->setY($yposdinamic+20);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"Powered by IhabDynamicsCode");

$pdf->output('archivo_pdf.pdf', 'D');