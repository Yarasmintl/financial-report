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
            'Fecha',
            'Folio de operacion',
            'Concepto',
            'Subtotales'
        );
    
        fputcsv($salida, $headers);
        
        foreach ($_SESSION['utilities'] as $key => $value) {
            fputcsv($salida, array(
                $value['date_created'],
                $value['folio'],
                ucfirst($value['type']),
                $value['total'],
               
            ));
        }
    }

    

?>