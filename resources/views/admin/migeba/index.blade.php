@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">პროდუქტის მიღება</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <a style="width: 49%; padding:10px; font-size:25px;" class="btn btn-primary" href="migeba/ingredienti">ინგრედიენტის მიღება</a>

                <a style="width: 50%; padding:10px; font-size:25px;" class="btn btn-primary" href="migeba/product">პროდუქტის მიღება</a>

                <br>
                <br>
                <h3>პროდუქტები</h3>
                <table id="allProducts" class="table table-dark">
                    <thead>
                        <tr> 
                            <th >ID</th>
                            <th>სურათი</th>
                            <th >პროდუქტის სახელი</th>
                            <th>რაოდენობა</th>
                            <th>რაოდენობის ჩასწორება</th>

                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img src="{{$product->product_image}}" style="width: 100px;" alt=""></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_quantity}}</td> 
                            <td><a type="button" class="btn btn-success" href="productis-chasworeba/{{$product->id}}">რედაქტირება</a></td> 

                        </tr>
                        @endforeach
                    </tbody>
                  </table>

<br>
<hr>
<br>

        <h3>ინგრედიენტები</h3>
        <table id="allIngredienti" class="table table-dark">
            <thead>
                <tr> 
                    <th >ID</th>
                    <th>პროდუქტის სახელი</th>
                    <th>მიღების რაოდენობა</th>
                    <th>რაოდენობის ჩასწორება</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($ingredientebi as $ingredienti)
                <tr>
                    <td>{{$ingredienti->id}}</td>
                     <td>{{$ingredienti->product_name}}</td>
                    <td>{{$ingredienti->product_quantity}} </td> 
                    <td><a type="button" class="btn btn-success" href="ingredientis-chasworeba/{{$ingredienti->id}}">რედაქტირება</a></td> 

                </tr>
                @endforeach
            </tbody>
        </table>



        <h2>ინგრედიენტების და პროდუქტების მიღების რაოდენობები</h2>

        <p id="date_filter">
            <span id="date-label-from" class="date-label">დან: </span><input  class="date_range_filter date" type="date" 
               value="none" name="from" id="date_to_from" />
            <span id="date-label-to" class="date-label">მდე:<input class="date_range_filter date" type="date" name="to" id="date_to_migeba" />
         </p>

         <table id="example1" class="table">
            <thead>
                <tr> 
                    <th>პროდუქტი</th>
                    <th >მიღების რაოდენობა</th>
                    <th >გასავალი</th>

                  </tr>
            </thead>
            <tbody>


            </tbody>
          </table>

          <br>

          <table id="example2" class="table">
            <thead>
                <tr> 
                    <th>პროდუქტი</th>
                    <th >მიღების რაოდენობა</th>
                    <th >გასავალი</th>

                  </tr>
            </thead>
            <tbody>


            </tbody>
          </table>
          <br>

          <h2>მიღების არქივი</h2>
          <p id="date_filter">
            <span id="date-label-from" class="date-label">დან: </span><input  class="date_range_filter date" type="date" value="none" name="from" id="date_from_archive" />
            <span id="date-label-to" class="date-label">მდე:<input class="date_range_filter date" type="date" name="to" id="date_to_archive" />
         </p>


          <hr>
          <h3>ინგრედიენტები</h3>

          <table id="example_archive_ingredienti" class="table">
            <thead>
                <tr> 
                    <th>პროდუქტი</th>
                    <th>მიღების რაოდენობა</th>
                    <th>ერთეულის ფასი</th>
                    <th>გადახდილი თანხა</th>
                    <th>თარიღი</th>
                    <th>გაუქმება</th>
                  </tr>
            </thead>
            <tbody>


            </tbody>
          </table>
<hr>
          <h3>პროდუქტები</h3>

          <table id="example_archive_product" class="table">
            <thead>
                <tr> 
                    <th>პროდუქტი</th>
                    <th>მიღების რაოდენობა</th>
                    <th>ერთეულის ფასი</th>
                    <th>გადახდილი თანხა</th>
                    <th>თარიღი</th>
                    <th>გაუქმება</th>
                  </tr>
            </thead>
            <tbody>


            </tbody>
          </table>

            </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

$(document).ready(function() {
   var t = $('#example_archive_product').DataTable();
   var tIngredienti = $('#example_archive_ingredienti').DataTable();

   var allIngredienti = $('#allIngredienti').DataTable();
   var allProducts = $('#allProducts').DataTable();


    $("#date_to_archive").on("change", function() {
dan = $('#date_from_archive').val();
mde = $('#date_to_archive').val();
  $.ajax({
       url:"/migebaarchive",
       method:"GET",
       data: {from:dan, to:mde},
       success:function(data) {
           console.log(data);
        $("#example_archive_ingredienti > tbody").html("");
        $("#example_archive_product > tbody").html("");

        $.each(data["ingredienti"], function( k, v ) {

            tIngredienti.row.add( [
            v["product_name"],
            v["quantity"],
            v["erteulis_fasi"],
            v["erteulis_fasi"]*v["quantity"],
            v["created_at"],
            '<a class="btn btn-danger" href="/cancelMigeba/'+v["id"]+'">გაუქმება</a>'
        ] ).draw( false );

        });

        $.each(data["products"], function( k, v ) {

            t.row.add( [
            v["product_name"],
            v["quantity"],
            v["erteulis_fasi"],
            v["erteulis_fasi"]*v["quantity"],
            v["created_at"],
            '<a class="btn btn-danger" href="/cancelMigeba/'+v["id"]+'">გაუქმება</a>'
        ] ).draw( false );

        // $('#example_archive_product > tbody:last-child').append('<tr><td>'+v["product_name"]+'</td><td>'+v["quantity"]+'</td><td>'+v["erteulis_fasi"]+'₾</td><td>'+v["erteulis_fasi"]*v["quantity"]+'₾</td><td>'+v["created_at"]+'</td><td><a class="btn btn-danger" href="/cancelMigeba/'+v["id"]+'">გაუქმება</a></td></tr>');

        });

         }
  });
})
 



} ); 
$("#date_to_migeba").on("change", function() {
dan = $('#date_to_from').val();
mde = $('#date_to_migeba').val();

  $.ajax({
       url:"/sawyobiarchive",
       method:"GET",
       data: {from:dan, to:mde},
       success:function(data) {
           $("#example1 > tbody").html("");
           $("#example2 > tbody").html("");

           $.each(data["ingredientebi"], function( k, v ) {
            
            $('#example1 > tbody:last-child').append('<tr><td>'+v["product_name"]+'</td><td>'+v["buyQuantity"]+'</td><td>'+v["buyQuantity"]*v["erteulisFasi"]+'₾</td></tr>');

            });

            $.each(data["products"], function( k, v ) {
            
            $('#example2 > tbody:last-child').append('<tr><td>'+v["product_name"]+'</td><td>'+v["buyQuantity"]+'</td><td>'+v["buyQuantity"]*v["erteulisFasi"]+'₾</td></tr>');

            });

         }
  });
})

</script>

<style>
table.dataTable thead .sorting_asc {
    background-image: url(../images/sort_sasc.png) !important;
}
table.dataTable thead .sorting_desc {
    background-image: url(../images/sort_dsesc.png) !important;
}
</style>
@endsection