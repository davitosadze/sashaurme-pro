@extends('layout')

@section('title', 'საშაურმის პროგრამა')


@section('content')


    <section class="dashboard">
        <div class="side right">

          <div class="bot">
            
              <div class="orders-header add">
                  <span>დასახელება</span><span>რაოდენობა</span><span>ფასი</span><span>წაშლა</span>
              </div>
              
              <div  id="order_items" class="orders add">
              </div>
          </div>
        
          <div style="width: 40%; padding: 10px; border-radius:10px; bottom: 0; position: fixed; background: #f8f6fd; border-radius: 2px solid black; display: inline-block; font-size:25px;" class="jami">ჯამი: <div style="float: right;" id="jami2">0₾</div></div>


        </div>



        <div style="width: 100%;" class="side right">

            <form style="width: 90%;" class="addProducts" action="#">

              <div class="top full-2">

                @if($last_order)
                <button type="button" style="width: 250px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  წინა შეკვეთა
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">წინა შეკვეთა</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">დასახელება</th>
                              <th scope="col">ფასი</th>
                              <th scope="col">რაოდენობა</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($last_order as $l)
                            <tr>
                              <td>{{$l->product_name}} - {{$l->additional_info}}</td>
                              <td>{{$l->product_price}} ლარი</td>
                              <td>{{$l->quantity}}</td>

                            </tr>
                            @endforeach

                          </tbody>
                        </table>                      
                      </div>
                      <div class="modal-footer">

                        <a href="/cancel-order/{{$last_parent_order->id}}" style="width:100%; background-color:red; border:none;" type="button" class="btn btn-primary">შეკვეთის გაუქმება</a>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                
                <h1>შეკვეთა <span id="order_id" class="styled">{{$new_order_id}}</span></h1>
            </div>
            
              <div id="categories">
                @foreach($categories as $category)
                <div onclick="openCategory({{$category->id}})" style="background-image: url({{$category->category_image}});" data-toggle="modal" data-target="#category{{$category->id}}" class="category">
                    <span class="category-title">{{$category->category_name}}</span>
                </div>




                
                <div class="modal fade bd-example-modal-lg" id="category{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{$category->category_name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <table id="category_table{{$category->id}}" class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">სურათი</th>
                                    <th scope="col">დასახელება</th>
                                    <th scope="col">ფასი</th>
                                    <th scope="col">არჩევა</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <div id="table_data"></div>
                                </tbody>
                              </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>

                        </div>
                      </div>
                    </div>
                  </div>

                @endforeach
              </div>
 
  <!-- Modal -->

{{-- 
                <input type="text" placeholder="კომენტარი" name="description" id="description">
 
                <input id="add_to_cart" id="addItem" value="პროდუქტის დამატება"> --}}



                <div class="saleContainer">
                  {{-- <select name="pay_method" id="pay_method" class="standard">
                      
                      <option value="0" selected>ნაღდი</option>
                      <option value="ნაღდი" >ნაღდი</option>
                      <option value="ბარათი">ბარათი</option>
                      <option value="ნისია">ნისია</option>
     
      
                  </select> --}}
                  <input required hidden value="1" type="text" name="pay_method" id="pay_method">
                  <a class="payclass" id="nagdi" href="javascript:void(0)">ნაღდი</a>
                  <a class="payclass" id="barati" href="javascript:void(0)" >ბარათი</a>
                  <a class="payclass" id="nisia" href="javascript:void(0)" >ნისია</a>
                  <input required style="display: none;" type="text" name="mevale" placeholder="შეიყვანეთ მევალის ინფორმაცია ან სახელი გვარი" id="mevale">
                  <a href="#"><button onclick="calculateJami()" id="addOrder"type="button" class="btn btn-primary" data-toggle="modal" data-target="#successModal">შეკვეთის დამატება</button></a>  

                    
                  <!-- Modal -->
                  <div class="modal bd-example-modal-xl fade" id="successModal" tabindex="-3" role="dialog" aria-labelledby="successModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="successModalTitle">შეკვეთა წარმატებით დასრულდა</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <div class="left_side">
                            <input type="text" name="user_amount" id="userMoney" placeholder="თანხა">
                            <br>

                            <div style="text-align: center;" class="jami">
                              <h2 style="font-size: 50px; font-weight: bold;color: darkblue;display: inline-block;">ჯამი: <h2 style="font-size: 50px; font-weight: bold;color: red; margin-left:20px; display: inline-block;" id="jami"> 0</h2><h2 style="font-size: 50px; font-weight: bold;color: red; display: inline-block;">₾</h2> </h2>
                            </div>

                            <div style="text-align: center;" class="xurda">

                            <h2 style="font-size: 50px; font-weight: bold;color: darkblue;display: inline-block;">ხურდა: <h2 style="font-size: 50px; font-weight: bold;color: red; margin-left:20px; display: inline-block;" id="xurda"> 0</h2><h2 style="font-size: 50px; font-weight: bold;color: red; display: inline-block;">₾</h2> </h2>
                            </div>

  
                            <button id="sval1" class="gilaki">1</button>
                            <button id="sval2" class="gilaki">2</button>
                            <button id="sval3" class="gilaki">3</button>
          
                            <button id="sval4" class="gilaki">4</button>
                            <button id="sval5" class="gilaki">5</button>
                            <button id="sval6" class="gilaki">6</button>
                            
                            <button id="sval7" class="gilaki">7</button>
                            <button id="sval8" class="gilaki">8</button>
                            <button id="sval9" class="gilaki">9</button>
                            <button id="wertili" class="gilaki">.</button>
                            <button id="sval0" class="gilaki">0</button>

                            <button id="clear" style="font-size:20px;" class="gilaki">გასუფთავება</button>
                            


                          </div>


                          <div class="right_side">
                            <button onclick="dasruleba(1)" type="button" class="buttonFinish btn btn-primary">1 ქვითრის ბეჭდვა</button>
                            <br>
                            <br>
                            <button onclick="dasruleba(2)" type="button" class="buttonFinish btn btn-primary">2 ქვითრის ბეჭდვა</button>
                            <br>
                            <br>
                            <button onclick="dasruleba(0)"  type="button" class="buttonFinish btn btn-primary">დასრულება ქვითრის გარეშე</button>
  

                          </div>

                        </div>
                        <div class="modal-footer">
                  
                        </div>
                      </div>
                    </div>
                  </div>
    
              </div> 

            </form>

            


              
            



            
            <div class="modal fade bd-example-modal-lg" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="product_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                 
                     
                    <div class="container1">

                      

                      <input hidden type="text" name="price" value="" id="price">
                      <input hidden type="text" name="product" value="" id="product">
                      <input hidden type="text" name="product_name_inp" id="product_name_inp">
                      <input hidden type="text" name="is_shaurma" id="is_shaurma">

  
                      <div style="display: none;" id="additional_info">
                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="უხახვო" id="uxaxvo">
                        <label class="form-check-label" for="uxaxvo">
                          უხახვო
                        </label>
                      </div>
    
                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="უწიწაკო" id="uwiwako">
                        <label class="form-check-label" for="uwiwako">
                          უწიწაკო
                        </label>
                      </div>
 
    
                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="უპამიდვრო" id="upamidvro">
                        <label class="form-check-label" for="upamidvro">
                          უპამიდვრო
                        </label>
                      </div>
                          
                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="დაჭ. წიწაკით" id="dachwiw">
                        <label class="form-check-label" for="dachwiw">
                          დაჭ. წიწაკით
                        </label>
                      </div>

                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="უმაიონეზო" id="umaionezo">
                        <label class="form-check-label" for="umaionezo">
                          უმაიონეზო
                        </label>
                      </div>


                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="უკეჩუპო" id="ukechupo">
                        <label class="form-check-label" for="ukechupo">
                          უკეჩუპო
                        </label>
                      </div>

                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="სალათის გარეშე" id="usalato">
                        <label class="form-check-label" for="usalato">
                          სალათის გარ.
                        </label>
                      </div>


                      <div class="shemadgenloba form-check">
                        <input name="shaurmaType[]" class="form-check-input" type="checkbox" value="სველი" id="sveli">
                        <label class="form-check-label" for="sveli">
                          სველი
                        </label>
                      </div>

                      <div style="padding:0; margin-top:10px;" class="form-check">
                        <input id="additionalInfo" style="width: 97%;" type="text" placeholder="დამატებითი ინფორმაცია">
                      </div>


                    </div>
                    
 
                    <div  class="row">
 
                      <input id="minus" type="button" value="-">
                      <input type="text" name="quantity" value="1" id="quantity">
                      <input id="plus" type="button" value="+">
                    </div>

                  </div>
    
                  <div class="container2">
  
                    <button id="val1" class="gilaki">1</button>
                    <button id="val2" class="gilaki">2</button>
                    <button id="val3" class="gilaki">3</button>
  
                    <button id="val4" class="gilaki">4</button>
                    <button id="val5" class="gilaki">5</button>
                    <button id="val6" class="gilaki">6</button>
                    
                    <button id="val7" class="gilaki">7</button>
                    <button id="val8" class="gilaki">8</button>
                    <button id="val9" class="gilaki">9</button>
<hr>


                  <button id="add_to_cart">კალათში დამატება</button>

                  <img id="product_image" src="">

                  </div>

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
  
                  </div>
                </div>
              </div>
            </div>

        </div>
    
    </section>
<style>
  
</style>

<script>

var selector = '.payclass ';

$(selector).on('click', function(){
    $(selector).removeClass('active');
    $(this).addClass('active');
});

$("#nisia").on("click",function(){
  $("#pay_method").val(3);
   $("#mevale").show();
})

$("#barati").on("click",function(){
  $("#pay_method").val(2);
   $("#mevale").hide();
})

$("#nagdi").on("click",function(){
  $("#pay_method").val(1);
   $("#mevale").hide();
})

function openCategory(category_id) {

  $.get("/subProducts/"+category_id+"", function (data) {

   $("#category_table"+category_id+" tr").empty();
   $("#category_table"+category_id+" tr:last").after(data);
   });
 
}

function openDetails(product_id) {
  $.get("/productDetails/"+product_id+"", function (data) {
 
    if(data["is_shaurma"]) {
      $("#additional_info").show();
    }
    else {
      $("#additional_info").hide();
    }
  $("#price").val(data["product_price"]);
  $("#product").val(data["id"]);
  $("#product_name_inp").val(data["product_name"]);
  $("#is_shaurma").val(data["is_shaurma"]);
  $("#product_image").attr("src",data["product_image"]);
  $("#product_name").text(data["product_name"]);

   });
}

function setPrice(default_price) {
    $("#price").val(default_price);
    $("#0").click();
}
</script>

@endsection