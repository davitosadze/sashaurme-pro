
 
var url = document.location.href.split('/');
order_id = url[4];

const edit_products_array = [];
create_item_array(order_id);
 

function create_item_array(order_id) {
    $.ajax({
        url:"/get/order_items_json/"+order_id+"",
        method:"get",
        data: {},
        
        success:function(data) {
            $.each(data, function(index) {

                var price = data[index].item_price;
                var quantity = data[index].quantity;
                var discount = data[index].discount;
                var description = data[index].comment;
                var product = data[index].item_name;
              
                var item = {
                 price: price*quantity,
                 quantity: quantity,
                 discount: discount,
                 description: description,
                 product_id: product
                }
                edit_products_array.push(item);
                
            });
        }
      });
}

 



function display_edit_products() { 

    items = "";
    edit_products_array.forEach(function(dt) {
        items += ' <div class="item" onclick="edit_product(\''+ dt['product_id'] + '\')"><span class="bold">'+ dt['product_id'] +'</span><p class="raod">'+ dt['quantity'] +'</p><p class="price">'+ dt['price'] +'ლ</p><button><img onclick="remove_from_edit_cart(\''+ dt['product_id'] + '\')" src="../images/delete.svg" alt=""></button><div class="description-show"></div><p class="description-show">x</p></div>'
    });
    $("#order_items").html(items);

}

 
function edit_product(product_name) {
    const index = edit_products_array.findIndex((element, index) => {
        if (element.product_id === product_name) {
          $("#price").val(element.price/element.quantity);
          $("#quantity").val(element.quantity);
          $("#description").val(element.description);
          $("#product_name").val(element.product_id);
          

          $("#" + element.product_id).click();
          $("#" + element.discount).click();


       }
     });
}

function remove_from_edit_cart(product_name) {
 
    const index = edit_products_array.findIndex((element, index) => {
       if (element.product_id === product_name) {
        edit_products_array.splice(index, 1);
        display_edit_products();
      }
    });
    
}

$("#update_product").on('click', function() {

    update_product()

}); 

function update_product() {
 
    product_name = $("#product_name").val();


    const index = edit_products_array.findIndex((element, index) => {
       if (element.product_id === product_name) {
           console.log(element);
           element.price = $("#price").val() * $("#quantity").val();
           element.description = $("#description").val();
           element.quantity = $("#quantity").val();
           element.product_id = $("#product").val();
           element.discount = $("#discount").val();

           $("#price").val("");
           $("#quantity").val('1');
           $("#description").val("");
           $("#product_name").val("");
           $("#" + element.product_id ).click();


      }
    });
    display_edit_products();
    console.log(edit_products_array);
}




$("#updateOrder").click(function(){

    var pay_method = $("#pay_method").val();

    var sub_total = 0;
    $.each(edit_products_array, function( index, value ) {
       sub_total += value['price'];
    });     

    $.ajax({
      url:"/update-order/"+order_id+"",
      method:"get",
      data: {products: edit_products_array, "_token": "{{ csrf_token() }}", pay_method:pay_method, sub_total:sub_total},
      
      success:function(data) {
        window.location.href = "/";
        


      } 

    });
});

$(document).ready(function() {
    setTimeout(function() {
        display_edit_products();
    }, 800);
  });