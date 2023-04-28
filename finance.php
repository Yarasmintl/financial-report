<?php

/*
Plugin Name: Financial Statement Generator
Plugin URI: https://www.myplugin.com
Description: Financial Statement Generator es un complemento que te ayudará a optimizar la
generación de tus reportes de compra, venta y balance general. Además que te permitirá la
descarga en formatos pdf y csv.
Version:1.0.0
Author:Yarasmin Lucero
Author URI:https://www.myplugin.com
License:GPL2
*/

require("constants.php");
require(PLUGIN_DIR.'includes/initialization.php');

$Initialization = new Initialization();
 
register_activation_hook( __FILE__, [$Initialization, 'activar']);
add_action('admin_menu',[$Initialization, 'create_menu']);

?>
