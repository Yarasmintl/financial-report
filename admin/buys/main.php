<div class="wrap">
    <?php
        require(PLUGIN_DIR."includes/header.php");
    ?>
    <table class="wp-list-table widefat fixed striped pages">
        <?php
            require(PLUGIN_DIR."admin/buys/thead.php");
        ?>
        <tbody class="the-list">
            <?php
                if(isset($_POST['option'])) { 
                    $start_date = $_POST['inicio'];
                    $end_date = $_POST['fin'];
                    $result = get_buys_by_date($start_date, $end_date);
                    require(PLUGIN_DIR."admin/buys/tbody.php");
                }
                elseif(isset($_POST['all'])){
                    $result = get_all_buys();
                    require(PLUGIN_DIR."admin/buys/tbody.php");
                }
                elseif(isset($_POST['pdf'])){
                    session_start();
                    ob_clean();
                    $type = 'compra';
                    $prefix = 'RC';
                    $last_folio_number = explode_folio(get_last_folio_by_type($type));
                    global $folio;
                    $folio = generate_report_folio($last_folio_number, $prefix);
                    generate_pdf($folio, $_SESSION['buy_head'], $_SESSION['buys']);
                    insert_folio_in_history($folio, $type, $_SESSION['buys']);       
                }
                else
                {
                    $result = get_all_buys();
                    require(PLUGIN_DIR."admin/buys/tbody.php");
                }
            ?>
        </tbody>
    </table>
</div>
