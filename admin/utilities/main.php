<div class="wrap">
    <?php
        require(PLUGIN_DIR."admin/utilities/header.php");
    ?>
    <table class="wp-list-table widefat fixed striped pages">
        <?php
            require(PLUGIN_DIR."admin/utilities/thead.php");
        ?>
        <tbody class="the-list">
            <?php
                if(isset($_POST['option'])) { 
                    $month = $_POST['inicio'];
                    $year = $_POST['fin'];
                
                    $res_sales = get_sales_by_month_year($month, $year); //get_sales_by_date($start_date, $end_date);
                    $res_buys = get_buys_by_month_year($month, $year); //get_buys_by_date($start_date, $end_date);

                    require(PLUGIN_DIR."admin/utilities/tbody.php");
                }
                elseif(isset($_POST['all'])){
                    $res_sales = get_sales_group_by_order();
                    $res_buys = get_buys_group_by_proveedor_date();
                    require(PLUGIN_DIR."admin/utilities/tbody.php");
                }
                elseif(isset($_POST['pdf'])){
                    session_start();
                    ob_clean();
                    $type = 'utilidad';
                    $prefix = 'RUB';
                    $last_folio_number = explode_folio(get_last_folio_by_type($type));
                    global $folio;
                    $folio = generate_report_folio($last_folio_number, $prefix);
                    generate_pdf($folio, $_SESSION['utility_head'], $_SESSION['utilities']);  
                }
                else
                {
                    $res_sales = get_sales_group_by_order();
                    $res_buys = get_buys_group_by_proveedor_date();
                    require(PLUGIN_DIR."admin/utilities/tbody.php");
                }
            ?>
        </tbody>
    </table>
</div>
