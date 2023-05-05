<?php
if(!empty($result)){     
    $cont = 1;
    
    session_start();
    $_SESSION['sales'] = array();
    $array_date = array();

    foreach ($result as $key => $value) {
        $precio = number_format(($value['total_sales'] / $value['num_items_sold']),2);
        $subtotal = $value['net_total'];
        $num_items = $value['num_items_sold'];
        $user = $value['authorized'];
        $iva = number_format($value['tax_total'], 2);
        $shipping = number_format($value['shipping_total'], 2);

        $date = convert_to_date_format($value['date_created']);
        $concepto = clean_post_names($value['post_name']);

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
        <td><?php echo $user ?></td>
    </tr>
<?php
        $cont = $cont + 1;

        $row_sale = create_array_sales($date, $concepto, $precio, $num_items, $iva, $shipping, $subtotal, $user);
        
        session_start();
        array_push($_SESSION['sales'], $row_sale);
    }

    $date_start = get_min_date_sales($array_date);
    $date_end = get_max_date_sales($array_date);
    $operacion = "Reporte de ventas";

    $row_head = create_array_data_head($date_start, $date_end, $operacion);
    $_SESSION['sale_head'] = array();
    array_push($_SESSION['sale_head'], $row_head);
}
?>