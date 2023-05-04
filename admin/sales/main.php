<div class="wrap">
    <?php
        require(PLUGIN_DIR."includes/header.php");
    ?>
    <table class="wp-list-table widefat fixed striped pages">
        <?php
            require(PLUGIN_DIR."admin/sales/thead.php");
        ?>
        <tbody class="the-list">
            <?php
                if(isset($_POST['option'])) { 
                    $start_date = $_POST['inicio'];
                    $end_date = $_POST['fin'];
                    $result = get_sales_by_date($start_date, $end_date);
                    require(PLUGIN_DIR."admin/sales/tbody.php");
                }
                elseif(isset($_POST['all'])){
                    $result = get_sales_completed();
                    require(PLUGIN_DIR."admin/sales/tbody.php");
                }
                elseif(isset($_POST['pdf'])){
                    session_start();
                    ob_clean();
                    $type = 'venta';
                    $prefix = 'RV';
                    $last_folio_number = explode_folio(get_last_folio_by_type($type));
                    global $folio;
                    $folio = generate_report_folio($last_folio_number, $prefix);
                    generate_pdf($folio, $_SESSION['sale_head'], $_SESSION['sales']);                    
                }
                else
                {
                    $result = get_sales_completed();
                    require(PLUGIN_DIR."admin/sales/tbody.php");
                    create_view_customer_roles();
                    create_view_customer_names();
                    create_view_customer_last_names();
                }
            ?>
        </tbody>
    </table>
</div>
