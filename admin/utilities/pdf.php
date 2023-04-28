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
        $this->Cell(30,6,'FECHA',1,0,'C',1);
        $this->Cell(50,6,utf8_decode('FOLIO DE OPERACIÓN'),1,0,'C',1);
        $this->Cell(30,6,'CONCEPTO',1,0,'C',1);
        $this->Cell(40,6,'SUBTOTALES',1,1,'C',1);
        $this->SetFont('Helvetica','',8);  

        $tot_buy = 0;
        $tot_sale = 0;
        $code_rv = '';
        $code_rc = '';
        foreach ($result as $key => $value) {
            $this->Cell(20);
            $this->Cell(30,6,$value['date_created'],1,0,'C');
            $this->Cell(50,6,$value['folio'],1,0,'C');
            $this->Cell(30,6,ucfirst($value['type']),1,0,'C');
            $this->Cell(40,6,"$ ".number_format($value['total'], 2),1,1,'L');

            if($value['type']=='compra'){
                $tot_buy = $value['total'];
                $code_rc = explode_folio($value['folio']);
           
            }
            else if($value['type']=='venta'){
                $tot_sale = $value['total'];
                $code_rv = explode_folio($value['folio']);
            }

        }

        if($code_rc == $code_rv){
            $total_net = $tot_sale - $tot_buy;
            $porcentaje = ($total_net / $tot_sale)*100;
            $this->Ln(10);
            $this->Cell(90);
            $this->SetFillColor(232,232,232);
            $this->SetFont('Helvetica','B',8);
            $this->Cell(40,6,'UTILIDAD BRUTA ($): ',1,0,'L',1);
            $this->SetFont('Helvetica','',8);
            $this->Cell(40,6,"$ ".number_format($total_net , 2),1,0,'L');
            $this->Ln(6);
            $this->Cell(90);
            $this->SetFont('Helvetica','B',8);
            $this->Cell(40,6,'UTILIDAD BRUTA (%): ',1,0,'L',1);
            $this->SetFont('Helvetica','',8);
            $this->Cell(40,6,"% ".number_format($porcentaje, 2),1,0,'L');
     
        }
    }
    
    
}


?>