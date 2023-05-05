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

        $net_total = 0;
        $iva_total = 0;
        $shipping_total = 0;
        $subtotal = 0;
        
        foreach ($_SESSION['sales'] as $key => $value) {

            $net_total = $net_total + $value['total_sale'];
            $iva_total = $iva_total + $value['iva'];
            $shipping_total = $shipping_total + $value['shipping'];
            $subtotal = ($net_total - $iva_total) - $shipping_total;

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
        fputcsv($salida, array(
            ''
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'Subtotal de ventas:',
            $subtotal,
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'IVA(16%):',
            $iva_total,
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'Envios:',
            $shipping_total,
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'Total de ventas:',
            $net_total,
        ));
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
            'Envio',
            'Subtotal',
            'Proveedor'
        );
    
        fputcsv($salida, $headers);

        $net_total = 0;
        $iva_total = 0;
        $shipping_total = 0;
        $subtotal = 0;
        
        foreach ($_SESSION['buys'] as $key => $value) {

            $net_total = $net_total + $value['total_buy'];
            $iva_total = $iva_total + $value['iva'];
            $shipping_total = $shipping_total + $value['shipping'];
            $subtotal = ($net_total - $iva_total) - $shipping_total;

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

        fputcsv($salida, array(
            ''
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'Subtotal de compras:',
            $subtotal,
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'IVA(16%):',
            $iva_total,
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'Envios:',
            $shipping_total,
        ));
        fputcsv($salida, array(
            '', '', '', '', '', '',
            'Total de compras:',
            $net_total,
        ));
    
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
            'Total',
            'IVA Total',
        );
    
        fputcsv($salida, $headers);

        $tot_buy = 0;
        $tot_sale = 0;
        $iva_sale = 0;
        $iva_buy = 0;
        
        foreach ($_SESSION['utilities'] as $key => $value) {
            fputcsv($salida, array(
                $value['date_created'],
                $value['folio'],
                ucfirst($value['type']),
                $value['subtotal'],
                $value['iva'],
               
            ));
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

        fputcsv($salida, array(
            ''
        ));
        fputcsv($salida, array(
            '','','',
            'Total ventas:',
            $tot_sale,
        ));
        fputcsv($salida, array(
            '','','',
            'IVA(16%):',
            $iva_sale,
        ));
        fputcsv($salida, array(
            '','','',
            'Total compras:',
            $tot_buy,
        ));
        fputcsv($salida, array(
            '','','',
            'IVA(16%):',
            $iva_buy,
        ));
    
    }

    

?>