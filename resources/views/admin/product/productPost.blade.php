@extends('../../layouts.category_master')
@section('content')
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                      <a href="{{route('product#list')}}" class="text-dark ms-4 mt-3">
                                    <div>
                                        <i class="fa-solid fa-left-long me-2"></i>Back
                                    </div>
                                </a>
                                    <div class="card-title">
                                        <h3 class="text-center text-dark  title-2">Product Info </h3>
                                    </div>
                                    <hr>
                                     @if(session('msg'))
                                    <div class="mt-3 alert alert-success text-primary alert-dismissible fade show" role="alert">
                                        <strong>{{session('msg')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif
                                    <div class="row px-5 py-3">
                                        <div class="col-lg-4 text-end">
                                                <img  src="{{asset('storage/'.$product->product_image)}}" alt="">
                                          
                                        </div>
                                        <div class="col-lg-7 ms-3 mt-3">
                                            <h3 class="mb-4">
                                              {{$product->product_name}}
                                            </h3>

                                             <button class="btn btn-dark text-white"> <i class="fs-5 fa-solid fa-money-bill text-success me-1"></i>  {{$product->product_price}}MMK</button>
                                             <button class="btn btn-dark text-white"> <i class="fs-5 fa-solid fa-database text-white me-1"></i>  {{$product->category_name}}</button>
                                              <button class="btn btn-dark text-white"> <i class="fs-5 fa-solid fa-hourglass-half text-warning me-1"></i>  {{$product->waiting_time}} Min</button>
                                             <button class="btn btn-dark text-white"> <i class="fs-5 fa-solid fa-eye text-danger me-1"></i>  0 Views</button>
                                             <button class="mt-2 btn btn-dark text-white"> <i class="fs-5 fa-solid fa-calendar-days text-white me-1"></i>{{$product->created_at->format('F-j-Y')}}</button>
                                           <h4 class="mt-4 mb-2"> <i class="fa-solid fa-circle-info me-1 text-primary"></i>Details</h4>
                                             <div class="mb-3">
                                               {{$product->product_description}}
                                            </div>
                        
                                            <a href="" class="mt-3">
                                                <button class="btn btn-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection