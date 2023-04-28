<?php
    require(PLUGIN_DIR.'admin/sales/save.php');
    require(PLUGIN_DIR.'admin/buys/save.php');

    $result_customers = get_customers_data();
    $result_posts = get_post_type_product();  
?>
<body>
    <input type="checkbox" id="btn-modal">

    <div class="container-modal">
        <div class="content-modal">
            <div class="btn-cerrar">
                <label for="btn-modal">
                    <img src="<?php echo PLUGIN_DIR_URL.'public/images/bx-x.svg'?>" class="icon">
                </label>
            </div>
            <h2>Registro de <?php echo $title?></h2>
            <?php 
                if($title == "Ventas"){
            ?>
                    <p>
                        <?php require(PLUGIN_DIR.'admin/sales/form-register.php'); ?> 
                    </p>
            <?php 
                }
                else{
            ?>
                    <p>
                        <?php require(PLUGIN_DIR.'admin/buys/form-register.php'); ?> 
                    </p>      
            <?php 
                }
            ?>
        </div>
        <label for="btn-modal" class="cerrar-modal"></label>
    </div>

</body>
