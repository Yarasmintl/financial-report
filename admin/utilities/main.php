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
                    $start_date = $_POST['inicio'];
                    $end_date = $_POST['fin'];
                    $result = get_history_reports_by_date($start_date, $end_date);
                    require(PLUGIN_DIR."admin/utilities/tbody.php");
                }
                elseif(isset($_POST['all'])){
                    $result = get_all_history();
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
                    insert_folio_in_history($folio, $type, $_SESSION['utilities']);       
                }
                else
                {
                    $result = get_all_history();
                    require(PLUGIN_DIR."admin/utilities/tbody.php");
                }
            ?>
        </tbody>
    </table>
</div>
