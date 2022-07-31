@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">ნისიის დამატება</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
 
                <form action="/back/nisia/insertNisia" method="POST">
                    @csrf
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">მევალის სახელი</label>
                      <input name="mevale" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="მევალის სახელი">
                    </div>
                
                          
                    <div class="form-group">
                      <label for="exampleInputEmail1">რაოდენობა ₾</label>
                      <input name="raodenoba" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="რაოდენობა ₾">
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