@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">პროდუქტის დამატება</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form action='insert' method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="checkbox" id="is_shaurma" value="1" name="is_shaurma" name="" id="">
                        <label for="is_shaurma">შაურმა</label>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">პური</label>
                        <select required name="puris_id" class="form-control" id="">
                            <option value="0" selected>აირჩიეთ პური</option>
                            @foreach ($puri as $p)
                            <option value="{{$p->id}}">{{$p->product_name}}</option>

                            @endforeach
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1">პროდუქტის კატეგორია</label>
                        <select required name="productCategory" class="form-control" id="">
                            <option value="0" selected>აირჩიეთ კატეგორია</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>

                            @endforeach
                        </select>
                    </div>




                    <div class="form-group">
                      <label for="exampleInputEmail1">პროდუქტის სახელი</label>
                      <input name="productName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="პროდუქტის სახელი">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">პროდუქტის ფასი ლარებში</label>
                        <input name="productPrice" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="პროდუქტის ფასი ლარებში">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">პროდუქტის რაოდენობა</label>
                        <input name="productQuantity" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="პროდუქტის რაოდენობა">
                      </div>

                
                    <div class="form-group">
                        <label for="exampleInputEmail1">პროდუქტის სურათი</label>
                        <input name="productImage" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
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