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
                            <select class="width-inputs-form" name="products" id="products">
                                <option value="-1">Seleccionar...</option>
                                <?php 
                                    foreach ($result_posts as $posts => $post) {
                                ?>
                                <option value="<?php echo $post['ID']?>"><?php echo clean_post_names($post['post_name'])?> </option>
                                <?php
                                    }
                                ?>
                            </select>
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
                            <input class="width-inputs-form" min="1" type="number" onkeyup="calculate_iva()" onkeypress="return validateNumbers(event)" name="num_items" id="num_items">
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
                            <input class="width-inputs-form" min="0" type="number" onkeypress="return validateNumbers(event)" id="iva" name="iva">
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
                            <input class="width-inputs-form" min="0" type="number" onkeypress="return validateNumbers(event)" id="shipping_total" name="shipping_total">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="titles">
                        <label class="labels">Cliente:</label></td>
                    </td>
                    <td class="contents">
                        <div class="group">
                            <img src="<?php echo PLUGIN_DIR_URL.'public/images/icons/user-solid.svg';?>">
                            <select class="width-inputs-form" name="customers" id="customers">
                                <option value="-1">Cliente...</option>
                                <?php 
                                    foreach ($result_customers as $customers => $customer) {
                                ?>
                                <option value="<?php echo $customer['user_id']?>"><?php echo $customer['name']." ".$customer['last_name']?> </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><br><br>
                        <input type="submit" onfocus="validatorFormSales()" name="newsale" class="button button-primary" value="Añadir nueva venta">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
