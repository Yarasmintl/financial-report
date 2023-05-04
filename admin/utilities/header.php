<?php
    require(PLUGIN_DIR."admin/sql/select.php");
    require(PLUGIN_DIR."includes/helpers.php");
    require(PLUGIN_DIR."admin/sql/insert.php");
    require(PLUGIN_DIR."includes/utilities.php");
    require(PLUGIN_DIR."admin/utilities/pdf.php");

    $title = get_admin_page_title();
?>
<head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="<?php echo PLUGIN_DIR_URL.'public/css/labels.css';?>">
    <link rel="stylesheet" href="<?php echo PLUGIN_DIR_URL.'public/css/modal.css';?>">
    <link rel="stylesheet" href="<?php echo PLUGIN_DIR_URL.'public/css/form.css';?>">
    <script src="<?php echo PLUGIN_DIR_URL.'public/js/validate.js';?>"></script>
</head>
<h1 class='wp-heading-inline'> <?php echo $title ?> </h1>

<?php require(PLUGIN_DIR.'admin/register.php');?>

<br><br><br>

<div class="tablenav top">	
    <div class="alignleft actions bulkactions"> 
        <form method="post" action="#">
            <select name="inicio">
                <?php
                $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    for($i=1; $i<=12; $i++) {

                        $i = str_pad($i, 2, "0", STR_PAD_LEFT);

                        if ($i == date('m')){
                            
                            echo '<option value="'.$i.'" selected>'.$months[($i-1)].'</option>';
                        }
                        else{
                            echo '<option value="'.$i.'">'.$months[($i-1)].'</option>';
                        }
                    }
                ?>
            </select>

            <select name="fin">
                <?php
                    for($i=date('o'); $i>=1910; $i--){
                        if ($i == date('o'))
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        else
                            echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
            </select>               
            <input type="submit" onfocus="validateDate()" name="option" class="button action" value="Filtrar">
            <input type="submit" name="all" class="button action left" value="Mostrar todo">
            <input type="submit" name="pdf" class="button action" value="Descargar PDF">
            <input type="submit" formaction="<?php echo PLUGIN_DIR_URL.'includes/csv.php'?>" name="csv" class="button action" value="Descargar CSV">
        </form>
    </div>		
</div>
<br>
