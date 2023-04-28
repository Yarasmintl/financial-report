<?php
    if(isset($_POST['newbuy'])) {
        $product = $_POST['product'];
        $num_items = (!empty($_POST['num_items']))? $_POST['num_items']:0;
        $price = (!empty($_POST['price']))? $_POST['price']:0;


        $iva = (!empty($_POST['iva']))? $_POST['iva']:0;
        $envio = (!empty($_POST['shipping_total']))? $_POST['shipping_total']:0;
        $proveedor = $_POST['proveedor'];

        $date = date("Y-m-d H:i:s");
       
        
        $res_stats = insert_buy($date, $product, $num_items, $price, $iva, $envio, $proveedor);
        if($res_stats){
        ?>
            <script>
                swal("Compra registrada", "¡La compra fue registrada exitosamente!", "success");
            </script>
        <?php
        }else{
        ?>
            <script>
                swal("Compra no registrada", "¡Ha ocurrido un error, intentarlo mas tarde!", "error");
            </script><?php
        }
    }

?>