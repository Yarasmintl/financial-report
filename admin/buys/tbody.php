<?php
if(!empty($result)){     
    $cont = 1;
    
    session_start();
    $_SESSION['buys'] = array();
    $array_date = array();

    foreach ($result as $key => $value) {
        $precio = number_format($value['price'],2);
        $num_items = $value['num_items'];
        $total_buy = $precio * $num_items;
       
        $iva = number_format($value['iva'], 2);
        $shipping = number_format($value['shipping_total'], 2);

        $subtotal = $total_buy + $iva + $shipping;
        
        $proveedor = $value['proveedor'];
        

        $date = convert_to_date_format($value['date_created']);
        $concepto = $value['concept'];

        array_push($array_date, $date);
?>
    <tr>
        <td><?php echo $cont ?></td>
        <td><?php echo $date ?></td>
        <td><?php echo $concepto ?></td>
        <td><?php echo "$ ".$precio ?></td>
        <td><?php echo $num_items ?></td>
        <td><?php echo "$ ".$iva ?></td>
        <td><?php echo "$ ".$shipping ?></td>
        <td><?php echo "$ ".number_format($subtotal,2) ?></td>
        <td><?php echo $proveedor ?></td>
    </tr>
<?php
        $cont = $cont + 1;

        $row_buy = create_array_buys($date, $concepto, $precio, $num_items, $iva, $shipping, $subtotal, $proveedor);
        
        session_start();
        array_push($_SESSION['buys'], $row_buy);
    }

    $date_start = get_min_date_sales($array_date);
    $date_end = get_max_date_sales($array_date);
    $operacion = "Reporte de compras";

    $row_head = create_array_data_head($date_start, $date_end, $operacion);
    $_SESSION['buy_head'] = array();
    array_push($_SESSION['buy_head'], $row_head);
}
?>