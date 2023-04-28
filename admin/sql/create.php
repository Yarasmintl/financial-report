<?php

function create_table_buys(){
    
    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}buys(
        id INT NOT NULL AUTO_INCREMENT,
        date_created DATE NOT NULL,
        concept TEXT NOT NULL, 
        price REAL NOT NULL,
        num_items INT NOT NULL,
        proveedor VARCHAR(100) NOT NULL,
        iva REAL NOT NULL,
        shipping_total REAL NOT NULL,
        PRIMARY KEY (id)
    )";

    $wpdb->query($sql);
}


function create_table_history_reports(){
    
    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}history_reports(
        id INT NOT NULL AUTO_INCREMENT,
        date_created DATE NOT NULL,
        folio VARCHAR(12) NOT NULL, 
        report_type VARCHAR(20) NOT NULL,
        total REAL NOT NULL, 
        PRIMARY KEY (id)
    )";

    $wpdb->query($sql);
}


function create_view_customer_roles(){
    global $wpdb;
    $rol = 'a:1:{s:8:"customer";b:1;}';

    $sql = "CREATE OR REPLACE VIEW view_roles AS 
              SELECT user_id, meta_value AS rol 
              FROM {$wpdb->prefix}usermeta AS data_users INNER JOIN {$wpdb->prefix}users AS users 
              ON data_users.user_id = users.ID AND meta_key ='wp_capabilities' 
              AND meta_value = '$rol'";
    $wpdb->query($sql);
}


function create_view_customer_names(){
    global $wpdb;
    $sql = "CREATE OR REPLACE VIEW view_names AS 
              SELECT user_id AS name_id, meta_value AS name 
              FROM {$wpdb->prefix}usermeta AS data_users INNER JOIN {$wpdb->prefix}users AS users 
              ON data_users.user_id = users.ID AND meta_key = 'first_name' 
              AND meta_value != ''";
     $wpdb->query($sql);
}


function create_view_customer_last_names(){
    global $wpdb;
    $sql = "CREATE OR REPLACE VIEW view_last_name AS 
              SELECT user_id AS last_id, meta_value AS last_name 
              FROM {$wpdb->prefix}usermeta AS data_users INNER JOIN {$wpdb->prefix}users AS users 
              ON data_users.user_id = users.ID AND meta_key = 'last_name' 
              AND meta_value != ''";
    $wpdb->query($sql);
}

function add_column_in_order_stats(){
    global $wpdb;
    $sql = "ALTER TABLE {$wpdb->prefix}wc_order_stats 
            ADD authorized VARCHAR(100) AFTER customer_id";
    $wpdb->query($sql);
}

function alter_column_authorized(){
    global $wpdb;
    $sql = "ALTER TABLE {$wpdb->prefix}wc_order_stats ALTER authorized SET DEFAULT 'Sistema'";
    $wpdb->query($sql);
}

?>