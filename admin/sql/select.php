<?php

function get_sales_by_date($start_date, $end_date){

    global $wpdb;
        
    $query = "SELECT sale.date_created, sale.num_items_sold, sale.total_sales, sale.net_total,
              sale.tax_total, sale.shipping_total, product.post_name, sale.authorized
              FROM {$wpdb->prefix}wc_order_stats AS sale
              INNER JOIN {$wpdb->prefix}wc_order_product_lookup AS order_product
              ON sale.order_id = order_product.order_id 
              INNER  JOIN {$wpdb->prefix}posts as product 
              ON order_product.product_id = product.ID 
              WHERE DATE(sale.date_created) 
              BETWEEN '$start_date' AND '$end_date'
              AND sale.status='wc-completed'";

    $result = $wpdb->get_results($query, ARRAY_A);
    
    return $result;
}

function get_buys_by_date($start_date, $end_date){
    global $wpdb;

    $query = "SELECT date_created, concept, num_items, price, iva, shipping_total, proveedor 
              FROM {$wpdb->prefix}buys WHERE DATE(date_created) 
              BETWEEN '$start_date' AND '$end_date'";
    
    $result = $wpdb->get_results($query, ARRAY_A);
    
    return $result;
}

function get_all_history(){
    global $wpdb;

    $query = "SELECT * FROM {$wpdb->prefix}history_reports 
              WHERE date_created = (SELECT MAX(date_created)
                FROM {$wpdb->prefix}history_reports) AND report_type!='utilidad'
                ORDER BY id DESC LIMIT 2";
    
    $result = $wpdb->get_results($query, ARRAY_A);

    return $result;
}

function get_history_reports_by_date($start_date, $end_date){
    global $wpdb;

    $query = "SELECT * FROM {$wpdb->prefix}history_reports WHERE DATE(date_created) 
              BETWEEN '$start_date' AND '$end_date'";
    
    $result = $wpdb->get_results($query, ARRAY_A);
    
    return $result;
}

function get_all_buys(){
    global $wpdb;

    $query = "SELECT date_created, concept, num_items, price, iva, shipping_total, proveedor 
              FROM {$wpdb->prefix}buys";
    
    $result = $wpdb->get_results($query, ARRAY_A);

    return $result;
}


function get_sales_completed(){

    global $wpdb;

    $query = "SELECT sale.date_created, sale.num_items_sold, sale.total_sales, sale.net_total,
              sale.tax_total, sale.shipping_total, product.post_name, sale.authorized
              FROM {$wpdb->prefix}wc_order_stats AS sale
              INNER JOIN {$wpdb->prefix}wc_order_product_lookup AS order_product
              ON sale.order_id = order_product.order_id 
              INNER  JOIN {$wpdb->prefix}posts as product 
              ON order_product.product_id = product.ID
              AND sale.status='wc-completed'";

    $result = $wpdb->get_results($query, ARRAY_A);

    return $result;
}


function get_last_order_stats(){
    global $wpdb;

    $query =$wpdb->get_row("SELECT * FROM {$wpdb->prefix}wc_order_stats 
                            ORDER BY order_id DESC LIMIT 1", ARRAY_A);
    return $query['order_id'];
}


function get_last_order_product(){
    global $wpdb;

    $query =$wpdb->get_row("SELECT * FROM {$wpdb->prefix}wc_order_product_lookup
                            ORDER BY order_item_id DESC LIMIT 1", ARRAY_A);
    return $query['order_item_id'];
}


function get_post_type_product(){
    global $wpdb;

    $query = "SELECT DISTINCT ID, post_name FROM {$wpdb->prefix}posts 
              WHERE post_type ='product' and post_name!=''";
    
    $result = $wpdb->get_results($query, ARRAY_A);

    return $result;
}


function get_customers_data(){
    global $wpdb;
    $query = "SELECT rol.user_id, rol.rol, name.name, last_name.last_name
              FROM view_roles AS rol INNER JOIN view_names AS name ON rol.user_id = name.name_id 
              INNER JOIN view_last_name AS last_name ON rol.user_id = last_name.last_id 
              ORDER BY rol.user_id ASC";

    $result = $wpdb->get_results($query, ARRAY_A);

    return $result;
}

function get_last_folio_by_type($type){
    global $wpdb;
    $query = $wpdb->get_row("SELECT folio FROM {$wpdb->prefix}history_reports where report_type = '$type'
                            ORDER BY folio DESC LIMIT 1", ARRAY_A);
    return $query['folio'];
}

?>