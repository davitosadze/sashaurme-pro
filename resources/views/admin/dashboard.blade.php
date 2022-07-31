@extends('admin.layout')

@section('content')
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">მთავარი</h4> </div>
 
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                <!-- .row -->

                

                <div class="row">
                    @foreach ($categoryArr as $item)
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">დღეს შეკვეთილი {{$item["category_name"]}}</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">{{$item["items_count"]}}</span></li>
                            </ul>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">დღეს შემოსავალი</h3>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{$today_sum}}</span>₾</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!--/.row -->
                <!--row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                             
                            <table id="example" class="table">
                                <thead>
                                    <tr> 
                                        <th >ID</th>
                                        <th>სურათი</th>
                                        <th >პროდუქტის სახელი</th>
                                        <th >დამატებითი ინფორმაცია</th>
                                        <th >რაოდენობა</th>
                                        <th >ჯამი</th>
                                        <th >გაუქმება</th>

                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td><img src="{{$order->product_image}}" style="width: 100px;" alt=""></td>
                                        <td>{{$order->product_name}}</td>
                                        <td>{{$order->additional_info}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->price * $order->quantity}}₾</td>
                                        <td><a type="button" class="btn btn-danger" href="/cancel-order/{{$order->id}}">გაუქმება</a></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>               
                        </div>
                    </div>
                </div>


            </div>
     
@endsection