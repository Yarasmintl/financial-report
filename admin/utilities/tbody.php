<?php
if(!empty($res_sales) || !empty($res_buys)){
    $cont_sales = 0;

    session_start();
    $_SESSION['utilities'] = array();
    $array_date = array();

    foreach ($res_sales as $key => $sales) {
        
        $subtotal_sales = $sales['total_net_sales'];        
        $date_sales = convert_to_date_format($sales['date_created']);
        $operation_sale = "Venta";
        $iva_sales = $sales['iva'];

        array_push($array_date, $date_sales);

        $folio_sales = generate_report_folio($cont_sales, "V");
    ?>
        <tr>
            <td><?php echo $folio_sales ?></td>
            <td><?php echo $operation_sale ?></td>
            <td><?php echo $date_sales ?></td>
            <td><?php echo "$ ".number_format($subtotal_sales, 2) ?></td>
            <td><?php echo "$ ".number_format($iva_sales, 2) ?></td>

        </tr>
    
<?php
        $cont_sales = $cont_sales + 1;

        $row_sale = create_array_utilities($folio_sales, $operation_sale, $date_sales, $subtotal_sales, $iva_sales);
        session_start();
        array_push($_SESSION['utilities'], $row_sale);

    }

    $cont_buys = 0;

    foreach ($res_buys as $key => $buys) {
        $subtotal_buys = $buys['total_net_buys'];        
        $date_buys = convert_to_date_format($buys['date_created']);
        $operation_buy = "Compra";
        $iva_buys = $buys['iva'];

        array_push($array_date, $date_buys);
        $folio_buys = generate_report_folio($cont_buys, "C");
?>
    <tr>
        <td><?php echo $folio_buys ?></td>
        <td><?php echo $operation_buy ?></td>
        <td><?php echo $date_buys ?></td>
        <td><?php echo "$ ".number_format($subtotal_buys, 2) ?></td>
        <td><?php echo "$ ".number_format($iva_buys, 2) ?></td>
    </tr>
    
<?php
        $cont_buys = $cont_buys + 1;

        $row_buy = create_array_utilities($folio_buys, $operation_buy,  $date_buys, $subtotal_buys, $iva_buys);
        session_start();
        array_push($_SESSION['utilities'], $row_buy);
    }

    $date_start = get_min_date_sales($array_date);
    $date_end = get_max_date_sales($array_date);
    $operacion = "Reporte de utilidad bruta";

    $row_head = create_array_data_head($date_start, $date_end, $operacion);
    $_SESSION['utility_head'] = array();
    array_push($_SESSION['utility_head'], $row_head);
}
?>