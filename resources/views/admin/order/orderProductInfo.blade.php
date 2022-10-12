@extends('../../layouts.category_master')
@section('content')
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool ">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <a href="{{route('order#list')}}"> <h3 class="text-dark"><i class="fa-solid fa-left-long me-1"></i>Back</h3></a>
                                       

                                    </div>
                                      </div>
                                </div>
                                <div class="bg-white rounded w-50 card py-3 ">
                                     <h4 class="card-title px-4">Order Info <i class="ms-1 fa-solid fa-circle-info"></i></h4><br>
                                    <div class="d-flex align-items-center px-4 pb-3" style="margin-top:-25px;border-bottom:1px solid black">
                                <i class="fa-solid fa-comment text-warning me-1"></i><span class="text-warning">Include Delivery Charges</span>
                                    
                                    </div>
                                     
                                    <div class="card-body px-4">
                                        <div class="mb-2 d-flex justify-content-between">
                                            <div>
                                                <i class="fa-solid fa-user me-1"></i>
                                                Name
                                            </div>
                                            <div>
                                               {{$order->user_name}}
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            <div>
                                                <i class="fa-solid fa-barcode me-1"></i>
                                                Order Code
                                            </div>
                                            <div>
                                                {{$order->order_code}}
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            <div>
                                              <i class="fa-regular fa-clock me-1"></i>
                                                Order Date
                                            </div>
                                            <div>
                                                {{$order->created_at->format('F-j-Y')}}
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            <div>
                                               <i class="me-1 fa-solid fa-money-bill"></i>
                                                Price
                                            </div>
                                            <div>
                                                {{$order->total_price}}
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                <div class="table-responsive table-responsive-data2 mb-3">
                                            <table class="table table-data2">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="col-lg-1">Order ID</th>
                                                        <th class="col-lg-2">Username</th>
                                                        <th class="col-lg-2">Product Image</th>
                                                        <th class="col-lg-2">Product Name</th>
                                                        <th class="col-lg-2">Order Date</th>
                                                        <th class="col-lg-1">Quantity</th>
                                                         <th class="col-lg-2">Amount</th>
                                                    </tr>
                                                </thead>
                                             <tbody>
                                           
                                            @foreach($orderLists as $o)
                                             <tr class="tr-shadow text-center">
                                                <input type="hidden" class="orderId" value="">
                                                <td class="col-lg-1">{{$o->id}}</td>
                                                <td class="col-lg-2">{{$o->user_name}}</td>
                                                <td class="col-lg-2">
                                                    <img src="{{asset('storage/'.$o->product_image)}}" alt="">
                                                </td>
                                                <td class="col-lg-2">{{$o->product_name}}</td>
                                                <td class="col-lg-2">{{$o->created_at->format('F-j-Y')}}</td>
                                                <td class="col-lg-1">{{$o->quantity}}</td>
                                                <td class="col-lg-2">{{$o->total_price}}</td>
                                               

                                            </tr>
                                            <tr class="spacer"></tr>
                                            @endforeach
                                           


                                            </tbody>
                                        </table>
                                        </div>
                                   

                            <!-- END DATA TABLE -->
                      
                              
@endsection
@section('myScript')

@endsection
