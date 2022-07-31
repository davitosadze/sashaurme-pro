@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">პროდუქტები</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <a class="btn btn-primary"  href="products/add">პროდუქტის დამატება</a>
<br>
<br>

                <table id="example" class="table">
                    <thead>
                        <tr> 
                            <th >ID</th>
                            <th>სურათი</th>
                            <th >კატეგორიის სახელი</th>
                            <th >პროდუქტის სახელი</th>
                            <th >რაოდენობა</th>
                            <th >რედაქტირება</th>
                            <th >წაშლა</th>
     
                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img src="{{$product->product_image}}" style="width: 100px;" alt=""></td>
                            <td>{{$product->category_name}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_quantity}}</td>

                            <td><a type="button" class="btn btn-success" href="products/edit/{{$product->id}}">რედაქტირება</a></td>
                            <td><a type="button" class="btn btn-danger" href="products/delete/{{$product->id}}">წაშლა</a></td>
 
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection