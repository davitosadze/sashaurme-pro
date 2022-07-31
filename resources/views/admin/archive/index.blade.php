@extends('admin.layout')

@section('content')

    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">არქივი</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">


                
            <p id="date_filter">
                <span id="date-label-from" class="date-label">დან: </span><input  class="date_range_filter date" type="date" 
                   value="none"
                  name="from" id="new_from" />
                <span id="date-label-to" class="date-label">მდე:<input class="date_range_filter date" type="date" name="to" id="new_to" />
             </p>

            <div class="row">
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">სულ გაყიდული პროდუქტი</h3>
                    <ul class="list-inline two-part">

                        <li class="text-right"><i class="ti-arrow-up text-success"></i> <span id="sul_gayiduli" class="counter text-success">0</span></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">შემოსავალი</h3>
                    <ul class="list-inline two-part">

                        <li class="text-right"><i class="ti-arrow-up text-success"></i> <span id="shemosavali" class="counter text-success">0</span>₾</li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-2 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">გასავალი</h3>
                    <ul class="list-inline two-part">

                        <li class="text-right"><i class="ti-arrow-up text-success"></i> <span id="gasavali" class="counter text-success">0</span>₾</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">მოგება</h3>
                    <ul class="list-inline two-part">

                        <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span id="mogeba" class="counter text-purple">0</span>₾</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">საშ. შემოსავალი</h3>
                    <ul class="list-inline two-part">

                        <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span id="sash_shemosavali" class="counter text-purple">0</span>₾</li>
                    </ul>
                </div>
            </div>

            </div>

            <div class="white-box">

                <table id="example1" class="table">
                    <thead>
                        <tr> 
                            <th>პროდუქტი</th>
                            <th >გაყიდვების რაოდენობა</th>
                            <th >შემოსავალი</th>
     
                          </tr>
                    </thead>
                    <tbody>
 

                    </tbody>
                  </table>


            </div>
    </div>
</div>

<style>
span#sul_gayiduli {
    font-weight: bold;
    color: green;
}

span#shemosavali {
    font-weight: bold;
    color: green;
}

span#gasavali {
    font-weight: bold;
    color: red;
}

span#mogeba {
    font-weight: bold;
    color: green;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
 
    $(document).ready(function() {
    $('#example').DataTable();
} );
 
$("#new_to").on("change", function() {
dan = $('#new_from').val();
  mde = $('#new_to').val();

  $.ajax({
       url:"/archivedata",
       method:"GET",
       data: {from:dan, to:mde},
       success:function(data) {
        $("#sul_gayiduli").text(data["sul_gayiduli"]);
        $("#shemosavali").text(data["shemosavali"]);
        $("#gasavali").text(data["gasavali"]);
        $("#mogeba").text(data["mogeba"]);
        $("#sash_shemosavali").text(data["sash_shemosavali"]);
        $("#example1 > tbody").html("");
        $.each(data["products"], function( k, v ) {
            
            $('#example1 > tbody:last-child').append('<tr><td>'+v["product_name"]+'</td><td>'+v["quantity"]+'</td><td>'+v["shemosavali"]+'₾</td></tr>');

        });

         }

  });

})

</script>
@endsection