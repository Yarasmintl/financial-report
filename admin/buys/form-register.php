<div class="content-form">
    <form action="#" method="post">
        <table>
            <tbody>
                <tr>
                    <td class="titles">
                        <label class="labels">Producto:</label>
                    </td>
                    <td class="contents">
                        <div class="group">
                            <img src="<?php echo PLUGIN_DIR_URL.'public/images/icons/product.svg';?>">
                            <input class="width-inputs-form" type="text" id="product" name="product">                           
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="titles">
                        <label class="labels">Cantidad:</label><br>
                    </td>
                    <td class="contents">
                        <div class="group">
                            <img src="<?php echo PLUGIN_DIR_URL.'public/images/icons/num-items.svg';?>">
                            <input class="width-inputs-form" min="1" type="number" onkeyup="calculate_iva()" onkeypress="return validateNumbers(event);" name="num_items" id="num_items">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="titles">
                        <label class="labels">Precio:</label>
                    </td>
                    <td class="contents">
                        <div class="group">
                            <img src="<?php echo PLUGIN_DIR_URL.'public/images/icons/moneda.svg';?>">
                            <input class="width-inputs-form" min="0" type="number" onkeyup="calculate_iva()" onkeypress="return validateNumbers(event)" name="price" id="price">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="titles">
                        <label class="labels">Monto IVA:</label>
                    </td>
                    <td class="contents">
                        <div class="group">
                            <img src="<?php echo PLUGIN_DIR_URL.'public/images/icons/moneda.svg';?>">
                            <input class="width-inputs-form" min="0" type="number" onkeypress="return validateNumbers(event);" id="iva" name="iva">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="titles">
                        <label class="labels">Monto envio:</label>
                    </td>
                    <td class="contents">
                        <div class="group">
                            <img src="<?php echo PLUGIN_DIR_URL.'public/images/icons/moneda.svg';?>">
                            <input class="width-inputs-form" min="0" type="number" onkeypress="return validateNumbers(event);" id="shipping_total" name="shipping_total">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="titles">
                        <label class="labels">Proveedor:</label></td>
                    </td>
                    <td class="contents">
                        <div class="group">
                            <img src="<?php echo PLUGIN_DIR_URL.'public/images/icons/user-solid.svg';?>">
                            <input class="width-inputs-form" type="text" id="proveedor" name="proveedor">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><br><br>
                        <input type="submit" onfocus="validatorFormBuys()" name="newbuy" class="button button-primary" value="Añadir nueva compra">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
