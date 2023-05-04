<?php
    session_start();
    $title = $_GET['title'];
    if($title=='Ventas'){
        foreach($_SESSION["sale_head"] as $key => $value){
            $start = $value['start'];
            $end = $value['end'];
        }
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="RV-'.$start.' al '.$end.'.csv"');
        
        $salida = fopen('php://output', 'w');
    
        $headers = array(
            'Fecha',
            'Concepto',
            'Precio',
            'Unidades',
            'IVA',
            'Envío',
            'Subtotal',
            'Responsable'
        );
    
        fputcsv($salida, $headers);
        
        foreach ($_SESSION['sales'] as $key => $value) {
            fputcsv($salida, array(
                $value['date_created'],
                $value['post_name'],
                $value['price'],
                $value['num_items'],
                $value['iva'],
                $value['shipping'],
                $value['total_sale'],
                $value['user']
            ));
        }
    }
    elseif($title=='Compras'){
        foreach($_SESSION["buy_head"] as $key => $value){
            $start = $value['start'];
            $end = $value['end'];
        }
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="RC-'.$start.' al '.$end.'.csv"');
        
        $salida = fopen('php://output', 'w');
    
        $headers = array(
            'Fecha',
            'Concepto',
            'Precio',
            'Unidades',
            'IVA',
            'Envío',
            'Subtotal',
            'Proveedor'
        );
    
        fputcsv($salida, $headers);
        
        foreach ($_SESSION['buys'] as $key => $value) {
            fputcsv($salida, array(
                $value['date_created'],
                $value['concept'],
                $value['price'],
                $value['num_items'],
                $value['iva'],
                $value['shipping'],
                $value['total_buy'],
                $value['proveedor']
            ));
        }
    }else{
        foreach($_SESSION["utility_head"] as $key => $value){
            $start = $value['start'];
            $end = $value['end'];
        }
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="RUB-'.$start.' al '.$end.'.csv"');
        
        $salida = fopen('php://output', 'w');
    
        $headers = array(
            'Folio',
            'Operación',
            'Fecha',
            'Subtotales'
        );
    
        fputcsv($salida, $headers);

        $tot_buy = 0;
        $tot_sale = 0;
        
        foreach ($_SESSION['utilities'] as $key => $value) {
            fputcsv($salida, array(
                $value['date_created'],
                $value['folio'],
                ucfirst($value['type']),
                $value['subtotal'],
               
            ));
            if($value['type']=='Compra'){
                $tot_buy = $tot_buy + $value['subtotal'];           
            }
            else if($value['type']=='Venta'){
                $tot_sale = $tot_sale + $value['subtotal'];
            }
        }

        $total_net = $tot_sale - $tot_buy;

        $iva_sale = $tot_sale * 0.16;
        $iva_buy = $tot_buy * 0.16;

        fputcsv($salida, array(
            ''
        ));
        fputcsv($salida, array(
            '',
            '',
            'Total ventas:',
            $tot_sale,
        ));
        fputcsv($salida, array(
            '',
            '',
            'IVA(16%):',
            $iva_sale,
        ));
        fputcsv($salida, array(
            '',
            '',
            'Total compras:',
            $tot_buy,
        ));
        fputcsv($salida, array(
            '',
            '',
            'IVA(16%):',
            $iva_buy,
        ));
    
    }

    

?>