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

                <form action='insertProducti' method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="exampleInputEmail1">აირჩიეთ პროდუქტი</label>
                        <select required name="product_id" class="form-control" id="">
                            <option value="0" selected>აირჩიეთ პროდუქტი</option>
                            @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->product_name}}</option>

                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">აირჩიეთ ერთეული</label>
                        <select required name="erteuli" class="form-control" id="">
                            <option value="0" selected>ცალი</option>
                            <option value="1">კგ</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">რაოდენობა</label>
                      <input name="quantity" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="რაოდენობა">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">ერთეულის ფასი</label>
                        <input name="price" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ერთეულის ფასი">
                    </div>
                
      
                    
                    <button type="submit" class="btn btn-primary">დამატება</button>
                  </form>
            
            
            </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection