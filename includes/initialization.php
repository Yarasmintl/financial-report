<?php

require(PLUGIN_DIR."admin/sql/create.php");
require(PLUGIN_DIR."includes/menus.php");

class Initialization {

    public function activar(){
        create_table_buys();
        create_table_history_reports();
        add_column_in_order_stats();
        alter_column_authorized();
    }


    public function create_menu(){
        create_menus();
    }
}

?>