 

  $(".item").click(function(){
    $(this).toggleClass("active");
      $(this).find('.description-show').slideToggle();
  })

 
  $(function() {
    $(".saleContainer a").each(function(idx) {
        var $this = $(this);
        var selectElm = $("select", $this.parent());
        

        $this.click(function() {
            $("a", $this.parent()).removeClass('active');
            $this.addClass('active');
            $('option', selectElm).eq(idx + 1).prop('selected', true);
        });
    });
    $(".clothesContainer a").each(function(idx) {
        var $this = $(this);
        var selectElm = $("select", $this.parent());
        

        $this.click(function() {
            $("a", $this.parent()).removeClass('active');
            $this.addClass('active');
            $('option', selectElm).eq(idx + 1).prop('selected', true);
        });
    });
});



 
// Produqtebis damateba kalatshi

const products_array = [];

$("#add_to_cart").click( function() {

  var price = $("#price").val();
  var quantity = $("#quantity").val();
  var product_name = $("#product_name_inp").val();
  var product = $("#product").val();
  var is_shaurma = $("#is_shaurma").val();


  if(is_shaurma == 1) {
    var product_with_details = product_name + " - ";
    var shaurmaType = [];
    var additionalInfo = []
    $(':checkbox:checked').each(function(i){
      shaurmaType[i] = $(this).val();
      product_with_details +=  $(this).val() + " ";
      additionalInfo +=  $(this).val() + ", ";


    });

    product_with_details += $("#additionalInfo").val();
    additionalInfo +=  $("#additionalInfo").val();

  
    if(shaurmaType.length == 0 && $("#additionalInfo").val() == 0 ) {
      product_with_details += " ყველაფრით";
      additionalInfo = "ყველაფრით"
    }

  }
  else {
    var product_with_details = product_name;
    additionalInfo = "";
  }
   
 
  let item = {
   default_name: product_name,
   product_name: product_with_details,
   price: price*quantity,
   each_price: price,
   quantity: quantity,
   product_id: product,
   additionalInfo: additionalInfo,
   is_shaurma: is_shaurma
  }
  products_array.push(item);


  var sub_total = 0;
  $.each(products_array, function( index, value ) {
     sub_total += value['price'];
  });  
  
  $("#additionalInfo").val("");

  $("#jami2").text(sub_total + "₾");

 display_products(products_array);
 console.log(is_shaurma);

 $('.modal').modal('hide');

 $('input[name="shaurmaType[]"]').each(function() {
  this.checked = false;
}); 
$("#quantity").val(1);

});



// Display cart products in order creating

function display_products(){

items = "";

  products_array.forEach(function(dt) {

 items += ' <div class="item"><span class="bold">'+ dt['product_name'] +'</span><span class="raod">'+ dt['quantity'] +'</span><span class="price">'+ Number(dt['price']).toFixed(2) +'ლ</span><button><img onclick="remove_from_cart(\''+ dt['product_id'] + '\')" src="../images/delete.svg" alt=""></button><div class="description-show"></div><p class="description-show">x</p></div>       '


  });
    $("#order_items").html(items);

}

//Store order items

function remove_from_cart(product_name) {

const index = products_array.findIndex((element, index) => {
  if (element.product_id === product_name) {
    products_array.splice(index, 1);

    sub_total = $("#jami2").text().replace(/\D/g, "");

    $("#jami2").text(sub_total - element.price + "₾")
    
    display_products();
    
  }
})

}
 
function xurda() {
  var sub_total = 0;
  $.each(products_array, function( index, value ) {
     sub_total += value['price'];
  });  
  
 $("#xurda").text(($("#userMoney").val()-sub_total).toFixed(2));
}

 
function calculateJami(){
  var sub_total = 0;
  $.each(products_array, function( index, value ) {
     sub_total += value['price'];
  });     
  $("#jami").text(sub_total);

}
 

function dasruleba(check_type) {

  var pay_method = $("#pay_method").val();
  var order_id = $("#order_id").text();
  var sub_total = 0;
  $.each(products_array, function( index, value ) {
     sub_total += value['price'];
  });     


  if(check_type==0) {
    location.reload();
  }
  else if(check_type == 1) {
    checkQuantity = 1;
  }
  else if(check_type == 2) {
    checkQuantity = 2;
  }

  $.ajax({
    url:"/print",
    method:"get",
    data: {products: products_array, order_id:order_id, check_type:checkQuantity, "_token": "{{ csrf_token() }}", pay_method:pay_method, sub_total:sub_total},        
    success:function(data) {
      location.reload();

    } 

  });


}

 $(".buttonFinish").on("click", function(){
  $(".buttonFinish").prop('disabled', true);

  
 });

$("#addOrder").click(function(){

 
      var pay_method = $("#pay_method").val();
      if(pay_method == 3) {
        is_nisia = 1;
        mevale = $("#mevale").val();
      }
      else {
        is_nisia = 0;
        mevale = "";
      }

      var sub_total = 0;
      $.each(products_array, function( index, value ) {
         sub_total += value['price'];
      });     

      $.ajax({
        url:"/create-order",
        method:"get",
        data: {products: products_array, "_token": "{{ csrf_token() }}", is_nisia:is_nisia, pay_method:pay_method, mevale:mevale, sub_total:sub_total},        
        success:function(data) {

        } 

      });
});

// Useris itemebis gamotana udashboard

function get_order_items(order_id){

  
      $.ajax({
        url:"/get/order_items/"+order_id+"",
        method:"get",
        data: {order_id: order_id, "_token": "{{ csrf_token() }}"},
        
        success:function(data) {
          $("#order_id_span").text("#" + order_id);

           $("#order_items").html(data);
           


        } 

      });

}

$("#plus").click( function() {
  var current_value = parseInt($("#quantity").val())
  $("#quantity").val(current_value+0);
})


$("#val1").click( function() {
  $("#quantity").val(1);
})
$("#val2").click( function() {
  $("#quantity").val(2);
})
$("#val3").click( function() {
  $("#quantity").val(3);
})
$("#val4").click( function() {
  $("#quantity").val(4);
})
$("#val5").click( function() {
  $("#quantity").val(5);
})
$("#val6").click( function() {
  $("#quantity").val(6);
})
$("#val7").click( function() {
  $("#quantity").val(7);
})
$("#val8").click( function() {
  $("#quantity").val(8);
})
$("#val9").click( function() {
  $("#quantity").val(9);
})




$("#sval1").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+1);
  xurda();
})
$("#sval2").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+2);
  xurda();
})
$("#sval3").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+3);
  xurda();
})
$("#sval4").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+4);
  xurda();
})
$("#sval5").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+5);
  xurda();
})
$("#sval6").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+6);
  xurda();
})
$("#sval7").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+7);
  xurda();
})
$("#sval8").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+8);
  xurda();
})
$("#sval9").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+9);
  xurda();
})
$("#wertili").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+".");
  xurda();
})

$("#sval0").click( function() {
  val = $("#userMoney").val();
  $("#userMoney").val(val+0);
  xurda();
})
$("#clear").click( function() {

  $("#userMoney").val("");
  xurda();
})




$("#minus").click( function() {
  var current_value = parseInt($("#quantity").val())
  $("#quantity").val(current_value-0);
})


function change_date(user_id){




  var selected_date = document.getElementById("date").value;
  var today_date = "";
  if(selected_date) {
    today_date = selected_date;
  }
  else {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    today_date = today;

  }
   

      $.ajax({
        url:"/get/user_orders_by_date/"+user_id+"/"+today_date+" ",
        method:"get",
        contentType: "application/json",
        dataType: "json",
        data: {user_id:user_id, date: today_date, "_token": "{{ csrf_token() }}"},
        
        success:function(data) {

          var html_data = "";
          var paid_card = 0;
          var paid_cash = 0;

          var cash_subtotal = 0;
          var card_subtotal = 0;
 
      $.each(data, function(i, item) {
        html_data += '<div onclick="get_order_items('+data[i].id+')" id="user_order" order_id ="'+data[i].id+'" class="order"><span class="styled">#'+data[i].id+'</span><p class="name">'+data[i].items_count+'</p><p class="price">'+data[i].subtotal+'₾</p></div>';
        if (data[i].pay_method == 0) {
          paid_cash += 1;
          cash_subtotal += data[i].subtotal;
        }
        else {
          paid_card += 1;
          card_subtotal += data[i].subtotal;
        }
      });

        //  $("#orders").html(html_data);
         $("#cash_orders_quantity").text(paid_cash);
         $("#card_orders_quantity").text(paid_card);

         $("#cash_subtotal").text(cash_subtotal + "₾");
         $("#card_subtotal").text(card_subtotal + "₾");



        } 

      });

}






function change_date_dashboard(){
  var selected_date = document.getElementById("date").value;
  var today_date = "";
  if(selected_date) {
    today_date = selected_date;
  }
  else {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    today_date = today;

  }
 
 

      $.ajax({
        url:"/get/orders_by_date/"+today_date+" ",
        method:"get",
        contentType: "application/json",
        dataType: "json",
        data: {date: today_date, "_token": "{{ csrf_token() }}"},
        
        success:function(data) {

          var html_data = "";
          var paid_card = 0;
          var paid_cash = 0;

          var cash_subtotal = 0;
          var card_subtotal = 0;
 
      $.each(data, function(i, item) {
        if(data[i].status == 1 ) { status = "მიღებულია" }
        else if (data[i].status == 2 ) { status = "გარეცხილია"  }
        else { status = "წაღებულია" }
        html_data += '<button style="background:transparent;border:0;outline:none;" onclick="get_order_items('+data[i].id+')" href="#"><div class="order"><span class="styled">#'+data[i].id+'</span><p class="name">'+data[i].first_name+' '+data[i].last_name+'</p><p class="price">'+data[i].subtotal+' GEL</p><div></div><div style="height:1vw",></div><div></div><a class="logouts" href="/edit-order/'+data[i].id+'">ჩასწორება</a><div> ' + 
        status
        '</div><a class="logouts" href="/delete-order/'+data[i].id+'">წაშლა</a></div></button>';
        if (data[i].pay_method == 0) {
          paid_cash += 1;
          cash_subtotal += data[i].subtotal;
        }
        else {
          paid_card += 1;
          card_subtotal += data[i].subtotal;
        }
      });

         $("#orders").html(html_data);
         $("#cash_orders_quantity").text(paid_cash);
         $("#card_orders_quantity").text(paid_card);

         $("#cash_subtotal").text(cash_subtotal + "₾");
         $("#card_subtotal").text(card_subtotal + "₾");



        } 

      });

}


$("#plus").click( function() {
  var current_value = parseInt($("#quantity").val())
  $("#quantity").val(current_value+1);
})

$("#minus").click( function() {
  var current_value = parseInt($("#quantity").val())
  $("#quantity").val(current_value-1);
})

var current_page = document.location.pathname.split("/").slice(1, 2).toString();


if (current_page == "dashboard") {
  change_date_dashboard();
}
else {
  var user_id = document.location.pathname.split("/").slice(2, 3).toString();
  change_date(user_id);
}