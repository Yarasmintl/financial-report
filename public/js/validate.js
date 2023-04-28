function validatorFormSales(){
    let products = document.getElementById("products").value;
    let num_items = document.getElementById("num_items").value;
    let price = document.getElementById("price").value;
    let customers = document.getElementById("customers").value;
    let iva = document.getElementById("iva").value;
    let shipping = document.getElementById("shipping_total").value;

    if(products == -1){
        swal("Usuario", "¡El producto es requerido!", "warning");
    }
    else if(num_items == '' || num_items == 0){
        swal("Usuario", "¡La cantidad minima aceptable es 1!", "warning");
    }
    else if(price == ''){
        swal("Usuario", "¡El precio es requerido!", "warning");
    }
    else if(price < 0 || num_items < 0 || iva < 0 || shipping < 0){
        swal("Usuario", "¡Los valores negativos no son validos!", "error");
    }
    else if(customers == -1){
        swal("Usuario", "¡El cliente el requerido!", "warning");
    }
}

function validatorFormBuys(){
    let product = document.getElementById("product").value;
    let num_items = document.getElementById("num_items").value;
    let price = document.getElementById("price").value;
    let proveedor = document.getElementById("proveedor").value;
    let iva = document.getElementById("iva").value;
    let shipping = document.getElementById("shipping_total").value;

    if(product == ''){
        swal("Usuario", "¡El producto es requerido!", "warning");
    }
    else if(num_items == '' || num_items == 0){
        swal("Usuario", "¡La cantidad minima aceptable es 1!", "warning");
    }
    else if(price == ''){
        swal("Usuario", "¡El precio es requerido!", "warning");
    }
    else if(price < 0 || num_items < 0 || iva < 0 || shipping < 0){
        swal("Usuario", "¡Los valores negativos no son validos!", "error");
    }
    else if(proveedor == ''){
        swal("Usuario", "¡El proveedor es requerido!", "warning");
    }
}

function validateDate(){
    let start = document.getElementById("inicio").value;
    let end = document.getElementById("fin").value;
    
    if(start == '' & end == ''){
        swal("Usuario", "¡Ambas fechas son requeridas!", "warning");
    }
    else if(start == ''){
        swal("Usuario", "¡Ingresa la fecha de inicio!", "warning");
    }
    else if(end == ''){
        swal("Usuario", "¡Ingresa la fecha de fin!", "warning");
    }
}


function validateNumbers(event){
    
    if(event.charCode >= 48 && event.charCode <= 57) { 
        return true;
    } 
    else{      
        swal("Usuario", "¡Solo se permiten números!", "warning");
        return false;    
    }

}


function calculate_iva(){
    let num_items = document.getElementById("num_items").value;
    let price = document.getElementById("price").value;
    let iva = document.getElementById("iva");
    
    let items = document.getElementById("num_items")
    items.addEventListener('input', e =>{
        num_items = document.getElementById("num_items").value;
    })

    let prices = document.getElementById("price")
    prices.addEventListener('input', e =>{
        price = document.getElementById("price").value;
    })

    let total_iva = (num_items * price) * 0.16;
    iva.value = total_iva;
    

}