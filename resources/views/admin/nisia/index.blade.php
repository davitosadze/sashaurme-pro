@extends('admin.layout')

@section('content')
    
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">ნისია</h4> </div>
 
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <a class="btn btn-primary" href="/back/nisia/damateba">ნისიის დამატება</a>
 
                <table class="table table-dark">
                    <thead>
                        <tr> 
                            <th >ID</th>
                            <th>მევალე</th>
                            <th >ჯამი</th>
                            <th >თარიღი</th>

                            <th>მივიღე</th>
     
                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($nisia as $n)
                        <tr>
                            <td>{{$n->id}}</td>
                            <td>{{$n->mevale}}</td>
                            <td>{{$n->sub_total}}₾</td>
                            <td>{{$n->created_at}}</td>
                            <td><a class="btn btn-primary" href="nisia/mivige/{{$n->id}}">მივიღე</a></td> 
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
 


<br>
<h2>მიღებული ნისიები</h2>
<br>

<table class="table table-dark">
    <thead>
        <tr> 
            <th >ID</th>
            <th>მევალე</th>
            <th >ჯამი</th>
            <th>მიღების თარიღი</th>

          </tr>
    </thead>
    <tbody>
        @foreach ($migebuli_nisiebi as $n)
        <tr>
            <td>{{$n->id}}</td>
            <td>{{$n->mevale}}</td>
            <td>{{$n->sub_total}}₾</td>
            <td>{{$n->updated_at}}</td> 
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