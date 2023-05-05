<?php
include(PLUGIN_DIR.'public/fpdf/fpdf.php');

function generate_pdf($folio, array $dates = [], array $result = []){
    $filename = $folio.'.pdf';

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->headTable($folio, $dates);
    $pdf->bodyTable($result);
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
            $this->Cell(20);
            $this->Cell(25,6,utf8_decode('Operación:'),1,0,'LO');
            $this->Cell(40,6,utf8_decode($value['operacion']),1,0,'LO');
            $this->Cell(10);
            $this->Cell(25,6,utf8_decode('Folio:'),1,0,'LO');
            $this->Cell(50,6,utf8_decode($folio),1,0,'LO');
            $this->Ln(10);
            $this->Cell(20);
            $this->Cell(25,6,utf8_decode('Emitido por:'),1,0,'LO');
            $this->Cell(40,6,utf8_decode($value['emision']),1,0,'LO');
            $this->Cell(10);
            $this->Cell(25,6,utf8_decode('Periodo:'),1,0,'LO');
            $this->Cell(50,6,utf8_decode($value['start'].' al '.$value['end']),1,0,'LO');
        }
    }
    
    function bodyTable(array $result = []){
        $this->Ln(10);
        $this->SetFillColor(232,232,232);
        $this->SetFont('Helvetica','B',8);
        $this->Cell(20);
        $this->Cell(30,6,'FOLIO',1,0,'C',1);
        $this->Cell(30,6,utf8_decode('OPERACIÓN'),1,0,'C',1);
        $this->Cell(30,6,'FECHA',1,0,'C',1);
        $this->Cell(35,6,'TOTAL',1,0,'C',1);
        $this->Cell(25,6,'IVA TOTAL',1,1,'C',1);
        $this->SetFont('Helvetica','',8);  

        $tot_buy = 0;
        $tot_sale = 0;

        $iva_sale = 0;
        $iva_buy = 0;
        foreach ($result as $key => $value) {
            $this->Cell(20);
            $this->Cell(30,6,$value['folio'],1,0,'C');
            $this->Cell(30,6,$value['type'],1,0,'C');
            $this->Cell(30,6,$value['date_created'],1,0,'C');
            $this->Cell(35,6,"$ ".number_format($value['subtotal'], 2),1,0,'L');
            $this->Cell(25,6,"$ ".number_format($value['iva'], 2),1,1,'L');

            if($value['type']=='Compra'){
                $tot_buy = $tot_buy + $value['subtotal'];
                $iva_buy = $iva_buy + $value['iva'];          
            }
            else if($value['type']=='Venta'){
                $tot_sale = $tot_sale + $value['subtotal'];
                $iva_sale = $iva_sale + $value['iva'];
            }
            

        }
        $total_net = $tot_sale - $tot_buy;

        $this->Ln(6);
        $this->Cell(130);
        $this->SetFont('Helvetica','',8);
        $this->Cell(40,6,"Total de ventas: $ ".number_format($tot_sale, 2),0,0,'R',0);
        $this->Ln(3);
       
        $this->Cell(130);
        $this->Cell(40,6,"IVA (16%): $ ".number_format($iva_sale, 2),0,0,'R',0);
        $this->Ln(6);

        $this->Cell(130);
        $this->Cell(40,6,"Total de compras: $ ".number_format($tot_buy, 2),0,0,'R',0);
        $this->Ln(3);
       
        $this->Cell(130);
        $this->Cell(40,6,"IVA (16%): $ ".number_format($iva_buy, 2),0,0,'R',0);
        $this->Ln(6);

        $this->Cell(130);
        $this->SetFont('Helvetica','B',8);
        $this->Cell(40,6,'Utilidad Bruta ($): '.number_format($total_net , 2),0,0,'R',0);
    }
    
}


?>