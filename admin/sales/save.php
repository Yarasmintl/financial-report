<?php
    if(isset($_POST['newsale'])) {
        $product_id = $_POST['products'];
        $num_items = (!empty($_POST['num_items']))? $_POST['num_items']:0;
        $price = (!empty($_POST['price']))? $_POST['price']:0;
        $total_sale = $price * $num_items;
        $iva = (!empty($_POST['iva']))? $_POST['iva']:0;
        $envio = (!empty($_POST['shipping_total']))? $_POST['shipping_total']:0;
        $net_total = $total_sale + $iva + $envio;
        $customer_id = $_POST['customers'];
        $date = date("Y-m-d H:i:s");
        global $current_user;
        $user = $current_user->display_name;
    
        $order_id = generate_order_id();
        $item_id = generate_order_item_id();

        $kwargs = [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'customer_id' => $customer_id,
            'num_items' => $num_items,
            'net_total' => $net_total,
            'date' => $date
        ];

        $res_stats = insert_order_stats($total_sale, $iva, $envio, $user, $kwargs);
        if($res_stats){
            if (insert_order_products($item_id, $kwargs)){
        ?>
                <script>
                    swal("Venta registrada", "¡La venta fue registrada exitosamente!", "success");
                </script>
        <?php
            }
        }else{
        ?>
                <script>
                    swal("Venta no registrada", "¡Ha ocurrido un error, intentarlo mas tarde!", "error");
                </script><?php
        }
    }

?>