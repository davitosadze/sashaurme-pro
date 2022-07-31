@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">საწყობის პროდუქტის რედაქტირება</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form action='/back/sproducts/update/{{$sproduct->id}}' method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">პროდუქტის სახელი</label>
                      <input value="{{$sproduct->product_name}}" name="sproductName" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="პროდუქტის სახელი">
                    </div>
                
                    <div class="form-group">
                        <input @if($sproduct->is_puri) checked @endif type="checkbox" name="is_puri" value="1" id=""> პური
                    </div>
                    
                    <button type="submit" class="btn btn-primary">განახლება</button>
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