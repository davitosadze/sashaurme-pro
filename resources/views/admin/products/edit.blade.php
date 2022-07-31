@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">პროდუქტის რედაქტირება</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form action='/back/products/update/{{$product->id}}' method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input  @if($product->is_shaurma) checked @endif type="checkbox" id="is_shaurma" value="1" name="is_shaurma" name="" id="">
                        <label class="is_shaurma" for="is_shaurma">შაურმა</label>

                    </div>

                    
                    <div class="puri form-group">
                        <label for="exampleInputEmail1">პური</label>
                        <select required name="puris_id" class="form-control" id="">
                            <option value="0" selected>აირჩიეთ პური</option>
                            @foreach ($puri as $p)
                            <option value="{{$p->id}}">{{$p->product_name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="selector form-group">
                        <label for="exampleInputEmail1">პროდუქტის კატეგორია</label>
                        <select required name="productCategory" class=" form-control" id="">
                            <option value="0" selected>აირჩიეთ კატეგორია</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">პროდუქტის სახელი</label>
                      <input value="{{$product->product_name}}" name="productName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="პროდუქტის სახელი">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">პროდუქტის ფასი ლარებში</label>
                        <input value="{{$product->product_price}}" name="productPrice" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="პროდუქტის ფასი ლარებში">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">პროდუქტის რაოდენობა</label>
                        <input value="{{$product->product_quantity}}" name="productQuantity" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="პროდუქტის რაოდენობა">
                      </div>

                
                      <img src="{{$product->product_image}}" style="width: 200px;" alt="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">პროდუქტის სურათი</label>
                        <input name="productImage" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      </div>
                    
                    <button type="submit" class="btn btn-primary">განახლება</button>
                  </form>
                
            </div>
    </div>
</div>
<style>

.is_shaurma {
    font-size:20px;
    margin-left:10px;
}

input[type=checkbox] {
    margin-top: 12px;
    -ms-transform: scale(3);
    -moz-transform: scale(3);
    -webkit-transform: scale(2);
    -o-transform: scale(3);
    padding: 15px;
    font-size: 25px;
    margin-left: 10px;
}
</style>
<script>
    $(".selector select").val("{{$product->product_category}}");
    $(".puri select").val("{{$product->puris_id}}");


    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection