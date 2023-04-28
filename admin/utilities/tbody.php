<?php
if(!empty($result)){     
    $cont = 1;
    
    session_start();
    $_SESSION['utilities'] = array();
    $array_date = array();

    foreach ($result as $key => $value) {
        $date = convert_to_date_format($value['date_created']);
        $type = $value['report_type'];
        $folio = $value['folio'];
        $total = $value['total'];

        array_push($array_date, $date);
?>
    <tr>
        <td><?php echo $cont ?></td>
        <td><?php echo $date ?></td>
        <td><?php echo ucfirst($type) ?></td>
        <td><?php echo $folio ?></td>
        <td><?php echo "$ ".number_format($total, 2) ?></td>
    </tr>
<?php
        $cont = $cont + 1;

        $row_buy = create_array_utilities($date, $type, $folio, $total);
        
        session_start();
        array_push($_SESSION['utilities'], $row_buy);
    }

    $date_start = get_min_date_sales($array_date);
    $date_end = get_max_date_sales($array_date);
    $operacion = "Reporte de utilidad bruta";

    $row_head = create_array_data_head($date_start, $date_end, $operacion);
    $_SESSION['utility_head'] = array();
    array_push($_SESSION['utility_head'], $row_head);
       
?>
<?php
}
?>