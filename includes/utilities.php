<?php

    function convert_to_date_format($date){
        $date = date('Y-m-d',strtotime($date));
        return $date;
    }

    function clean_post_names($post_name){
        $post_name = str_replace("-"," ",$post_name);
        $post_name = convert_first_letter_to_uppercase($post_name);
        return $post_name;
    }
    

    function convert_first_letter_to_uppercase($post_name){
        return ucfirst($post_name);
    }
    
    function generate_report_folio($last_number, $prefix){
        $new_number = $last_number + 1;
        $number_folio = str_pad($new_number, 3, "0", STR_PAD_LEFT);
        $folio = $prefix.'-'.$number_folio;
    
        return $folio;
    }


    function explode_folio($last_folio){
        if(isset($last_folio)){
            $array = explode("-", $last_folio);
            return $array[1];
        }
        else{
            return 0;
        }
    }

    
    function create_array_sales($date, $concepto, $precio, $num_items, $iva, $shipping, $subtotal, $user){
        $row = array(
            'date_created' => $date,
            'post_name' => $concepto,
            'price' => $precio,
            'num_items' => $num_items,
            'iva' => $iva,
            'shipping' => $shipping,
            'total_sale' => $subtotal,
            'user' => $user
        ); 

        return $row;
    }
    function create_array_utilities($folio, $operation, $date, $subtotal){
        $row = array(
            'folio' => $folio,
            'type' => $operation,
            'date_created' => $date,
            'subtotal' => $subtotal,
        );

        return $row;
    }

    
    function create_array_data_head($date_start, $date_end, $operacion){
        global $current_user;
        $row = array(
            'operacion' => $operacion,
            'emision' => $current_user->display_name,
            'start' => $date_start,
            'end' => $date_end,
        );
        return $row;
    }


    function create_array_buys($date, $concepto, $precio, $num_items, $iva, $shipping, $subtotal, $proveedor){
        $row = array(
            'date_created' => $date,
            'concept' => $concepto,
            'price' => $precio,
            'num_items' => $num_items,
            'iva' => $iva,
            'shipping' => $shipping,
            'total_buy' => $subtotal,
            'proveedor' => $proveedor
        );

        return $row;
    }



    function get_min_date_sales(array $dates = []){
        return min($dates);
    }
    
    
    function get_max_date_sales(array $dates = []){
        return max($dates);            
    }
?>