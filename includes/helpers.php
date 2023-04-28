<?php
    
    function generate_order_id(){
        $id = get_last_order_stats() + 1;
        return $id;
    }
    
    
    function generate_order_item_id(){
        $id = get_last_order_product() + 1;
        return $id;
    }

?>