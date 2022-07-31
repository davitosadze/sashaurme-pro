@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">დამატებითი ხარჯი</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <a class="btn btn-primary"  href="xarji/add">ახალი ხარჯი</a>
<br>
<br>


                <table id="example" class="table">
                    <thead>
                      <tr> 
                        <th >ID</th>
                        <th>რაოდენობა</th>
                        <th>თარიღი</th>

                      </tr>
                    </thead>
                    <tbody>
  
                            @foreach ($xarji as $xa)
                                
                            <tr>
                                <td>{{$xa->id}}</td>
                                 <td>{{$xa->amount}} ლარი</td>
                                 <td>{{$xa->created_at}}</td>

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