<?php

function insert_order_stats($total, $iva, $envio, $user, array $kwargs = []){
    
    global $wpdb;
    
    $wpdb->insert("{$wpdb->prefix}wc_order_stats", array(
		'order_id' => $kwargs['order_id'],
        'date_created' => $kwargs['date'],
        'date_created_gmt' => $kwargs['date'],
		'num_items_sold' => $kwargs['num_items'],
        'total_sales' => $total,
        'tax_total' => $iva,
        'shipping_total' => $envio,
        'net_total' => $kwargs['net_total'],
        'status' => 'wc-completed',
        'customer_id' => $kwargs['customer_id'],
        'authorized' => $user
	));
    return $wpdb;
}


function insert_order_products($id, array $kwargs = []){
    
    global $wpdb;

    $wpdb->insert("{$wpdb->prefix}wc_order_product_lookup", array(
		'order_item_id' => $id,
        'order_id' => $kwargs['order_id'],
		'product_id' => $kwargs['product_id'],
        'customer_id' => $kwargs['customer_id'],
        'date_created' => $kwargs['date'],
        'product_qty' => $kwargs['num_items'],
        'product_net_revenue' => $kwargs['net_total'],
        'product_gross_revenue' => $kwargs['net_total']
	));
    return $wpdb;

}

function insert_folio_in_history($folio, $type, array $data_report=[]){
    global $wpdb;
    $net_total = 0;
    foreach($data_report as $key => $value){
        if($type=='venta'){
            $net_total = $net_total + $value['total_sale'];
        }
        elseif($type=='compra'){
            $net_total = $net_total + $value['total_buy'];
        } 
        elseif($type=='utilidad'){
            $net_total = $net_total + $value['total'];
        }
    }
    $wpdb->insert("{$wpdb->prefix}history_reports", array(
		'date_created' => date('Y-m-d H:i:s'),
        'folio' => $folio,
		'report_type' => $type,
        'total' => $net_total
	));
    return $wpdb;
}

function insert_buy($date, $product, $num_items, $price, $iva, $envio, $proveedor){
    global $wpdb;

    $wpdb->insert("{$wpdb->prefix}buys", array(
		'date_created' => $date,
        'concept' => $product,
		'price' => $price,
        'num_items' => $num_items,
        'proveedor' => $proveedor,
        'iva' => $iva,
        'shipping_total' => $envio
	));
    return $wpdb;
}
?>