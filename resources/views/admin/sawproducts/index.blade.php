@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">საწყობის პროდუქტები</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <a class="btn btn-primary"  href="sproducts/add">პროდუქტის დამატება</a>
<br>
<br>


                <table id="example" class="table">
                    <thead>
                      <tr> 
                        <th >ID</th>
                        <th>პროდუქტის სახელი</th>
                        <th>რედაქტირება</th>
                        <th>წაშლა</th>

                      </tr>
                    </thead>
                    <tbody>
  
                            @foreach ($sproducts as $sproduct)
                                
                            <tr>
                                <td>{{$sproduct->id}}</td>
                                 <td>{{$sproduct->product_name}}</td>
    
                                <td><a type="button" class="btn btn-success" href="sproducts/edit/{{$sproduct->id}}">რედაქტირება</a></td>
                                <td><a type="button" class="btn btn-danger" href="sproducts/delete/{{$sproduct->id}}">წაშლა</a></td>
     
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