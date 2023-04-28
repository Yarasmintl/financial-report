<?php

function create_menus(){
    add_menu_page(
        'Contabilidad',
        'Contabilidad',
        'manage_options',
        'wp_menu',
         null,
         PLUGIN_DIR_URL.'public/images/icon.png',
        '1'
    );
    add_submenu_page(
        'wp_menu',
        'Ventas',
        'Ventas',
        'manage_options',
        'wp_menu',
        'show_sales'
    );
    add_submenu_page(
        'wp_menu',
        'Compras',
        'Compras',
        'manage_options',
        'wp_compras',
        'show_buys'

    );
    add_submenu_page(
        'wp_menu',
        'Utilidad Bruta',
        'Utilidad Bruta',
        'manage_options',
        'wp_balances',
        'show_ub'

    );
    function show_sales(){
        include(PLUGIN_DIR.'admin/sales/main.php');
    }

    
    function show_buys(){
        include(PLUGIN_DIR.'admin/buys/main.php');
    }


    function show_ub(){
        include(PLUGIN_DIR.'admin/utilities/main.php');
    }
}