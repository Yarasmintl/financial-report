<?php
include(PLUGIN_DIR.'public/fpdf/fpdf.php');

function generate_pdf($folio, array $dates = [], array $result = []){
    $filename = $folio.'.pdf';

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->headTable($folio, $dates);
    if(str_starts_with($folio, 'V')){
        $pdf->bodyTableSales($result);    
    }else{
        $pdf->bodyTableBuys($result);
    }
    $pdf->OutPut($filename, 'I');
}


class PDF extends FPDF {
    function Header() {
        $this->Image(PLUGIN_DIR_URL."public/images/main_logo.png", 85, 5, 40 );
        $this->Ln(5);
        $this->SetFont('Helvetica','B',10);
        $this->Cell(60);
        $this->Cell(70,10, utf8_decode('52975 El Potrero Atizapán Centro, Estado de México.'),0,0,'C');
        $this->Ln(8);
        $this->Cell(60);
        $this->Cell(70,10, 'REPORTE FINANCIERO',0,0,'C');
        $this->Ln(20);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Helvetica','I', 8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }	
    
    function headTable($folio, array $dates = []){
        $this->SetFont('Helvetica','',8);
        foreach ($dates as $key => $value) {
            $this->Cell(25,6,utf8_decode('Operación:'),1,0,'LO');
            $this->Cell(40,6,utf8_decode($value['operacion']),1,0,'LO');
            $this->Cell(54);
            $this->Cell(25,6,utf8_decode('Folio:'),1,0,'LO');
            $this->Cell(50,6,utf8_decode($folio),1,0,'LO');
            $this->Ln(10);
            $this->Cell(25,6,utf8_decode('Emitido por:'),1,0,'LO');
            $this->Cell(40,6,utf8_decode($value['emision']),1,0,'LO');
            $this->Cell(54);
            $this->Cell(25,6,utf8_decode('Periodo:'),1,0,'LO');
            $this->Cell(50,6,utf8_decode($value['start'].' al '.$value['end']),1,0,'LO');
        }
    }
    
    function bodyTableSales(array $result = []){
        $this->Ln(10);
        $this->SetFillColor(232,232,232);
        $this->SetFont('Helvetica','B',8);
        $this->Cell(20,6,'FECHA',1,0,'C',1);
        $this->Cell(50,6,'CONCEPTO',1,0,'C',1);
        $this->Cell(22,6,'PRECIO',1,0,'C',1);
        $this->Cell(20,6,'UNIDADES',1,0,'C',1);
        $this->Cell(26,6,'IVA',1,0,'C',1);
        $this->Cell(26,6,'ENVIO',1,0,'C',1);
        $this->Cell(30,6,'SUBTOTAL',1,1,'C',1);
        $this->SetFont('Helvetica','',8);  

        $net_total = 0;
        $iva_total = 0;
        $shipping_total = 0;
        $subtotal = 0;
        foreach ($result as $key => $value) {
            $net_total = $net_total + $value['total_sale'];
            $iva_total = $iva_total + $value['iva'];
            $shipping_total = $shipping_total + $value['shipping'];
            $subtotal = ($net_total - $iva_total) - $shipping_total;

            $this->Cell(20,6,$value['date_created'],1,0,'C');
            $this->Cell(50,6,utf8_decode($value['post_name']),1,0,'L');
            $this->Cell(22,6,"$ ".$value['price'],1,0,'L');
            $this->Cell(20,6,$value['num_items'],1,0,'C');
            $this->Cell(26,6,"$ ".$value['iva'],1,0,'L');
            $this->Cell(26,6,"$ ".$value['shipping'],1,0,'L');
            $this->Cell(30,6,"$ ".number_format($value['total_sale'], 2),1,1,'L');
        }
        $this->Ln(6);
        $this->Cell(154);
        $this->SetFont('Helvetica','',8);
        $this->Cell(40,6,"Subtotal de ventas: $ ".number_format($subtotal, 2),0,0,'R',0);
        $this->Ln(3);
       
        $this->Cell(154);
        $this->Cell(40,6,"IVA (16%): $ ".number_format($iva_total, 2),0,0,'R',0);
        $this->Ln(3);

        $this->Cell(154);
        $this->Cell(40,6,utf8_decode("Envíos: $ ").number_format($shipping_total, 2),0,0,'R',0);
        $this->Ln(6);

        $this->Cell(154);
        $this->Cell(40,6,"Total de ventas: $ ".number_format($net_total, 2),0,0,'R',0);
        $this->Ln(6);
    }
    
    function bodyTableBuys(array $result = []){
        $this->Ln(10);
        $this->SetFillColor(232,232,232);
        $this->SetFont('Helvetica','B',8);
        $this->Cell(17,6,'FECHA',1,0,'C',1);
        $this->Cell(40,6,'CONCEPTO',1,0,'C',1);
        $this->Cell(19,6,'PRECIO',1,0,'C',1);
        $this->Cell(20,6,'UNIDADES',1,0,'C',1);
        $this->Cell(21,6,'IVA',1,0,'C',1);
        $this->Cell(21,6,'ENVIO',1,0,'C',1);
        $this->Cell(21,6,'SUBTOTAL',1,0,'C',1);
        $this->Cell(35,6,'PROVEEDOR',1,1,'C',1);
        $this->SetFont('Helvetica','',8);  

        $net_total = 0;
        $iva_total = 0;
        $shipping_total = 0;
        $subtotal = 0;
        foreach ($result as $key => $value) {
            $net_total = $net_total + $value['total_buy'];
            $iva_total = $iva_total + $value['iva'];
            $shipping_total = $shipping_total + $value['shipping'];
            $subtotal = ($net_total - $iva_total) - $shipping_total;

            $this->Cell(17,6,$value['date_created'],1,0,'C');
            $this->Cell(40,6,utf8_decode($value['concept']),1,0,'L');
            $this->Cell(19,6,"$ ".$value['price'],1,0,'L');
            $this->Cell(20,6,$value['num_items'],1,0,'C');
            $this->Cell(21,6,"$ ".$value['iva'],1,0,'L');
            $this->Cell(21,6,"$ ".$value['shipping'],1,0,'L');
            $this->Cell(21,6,"$ ".number_format($value['total_buy'], 2),1,0,'L');
            $this->Cell(35,6,utf8_decode($value['proveedor']),1,1,'L');
        }
        $this->Ln(6);
        $this->Cell(154);
        $this->SetFont('Helvetica','',8);
        $this->Cell(40,6,"Subtotal de compras: $ ".number_format($subtotal, 2),0,0,'R',0);
        $this->Ln(3);
       
        $this->Cell(154);
        $this->Cell(40,6,"IVA (16%): $ ".number_format($iva_total, 2),0,0,'R',0);
        $this->Ln(3);

        $this->Cell(154);
        $this->Cell(40,6,utf8_decode("Envíos: $ ").number_format($shipping_total, 2),0,0,'R',0);
        $this->Ln(6);

        $this->Cell(154);
        $this->Cell(40,6,"Total de compras: $ ".number_format($net_total, 2),0,0,'R',0);
        $this->Ln(6);

    }
    
}


?>