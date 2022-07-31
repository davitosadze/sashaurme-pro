@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">კატეგორიები</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">


        <div class="col-md-12">
            <div class="white-box">

                <a class="btn btn-primary"  href="categories/add">კატეგორიის დამატება</a>
<br>
<br>
                <table id="example" class="table">
                    <thead>
                      <tr> 
                        <th >ID</th>
                        <th>სურათი</th>
                        <th >კატეგორიის სახელი</th>
                        <th >რედაქტირება</th>
                        <th >წაშლა</th>
 
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><img src="{{$category->category_image}}" style="width: 100px;" alt=""></td>
                            <td>{{$category->category_name}}</td>
                            <td><a type="button" class="btn btn-success" href="categories/edit/{{$category->id}}">რედაქტირება</a></td>
                            <td><a type="button" class="btn btn-danger" href="categories/delete/{{$category->id}}">წაშლა</a></td>
 
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