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
            <label class="labels">Fecha de inicio:</label>
            <input type="date" id="inicio" name="inicio">
            <label class="labels left">Fecha de fin:</label>
            <input type="date" id="fin" name="fin">                
            <input type="submit" onfocus="validateDate()" name="option" class="button action" value="Filtrar">
            <input type="submit" name="all" class="button action left" value="Mostrar todo">
            <input type="submit" name="pdf" class="button action" value="Descargar PDF">
            <input type="submit" formaction="<?php echo PLUGIN_DIR_URL.'includes/csv.php'?>" name="csv" class="button action" value="Descargar CSV">
        </form>
    </div>		
</div>
<br>
