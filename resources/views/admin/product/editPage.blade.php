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
                                        <h3 class="text-center text-dark  title-2">Edit Product </h3>
                                    </div>
                                    <hr>
                                     @if(session('msg'))
                                    <div class="mt-3 alert alert-success text-primary alert-dismissible fade show" role="alert">
                                        <strong>{{session('msg')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif
                                     <form action="{{route('product#update',$product->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                      <div class="row px-5 py-3">
                                        <div class="col-lg-4 text-center">
                                          
                                                    
                                                <img  src="{{asset('storage/'.$product->product_image)}}" alt="">
                                         
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"></label>
                                           <input  type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror">
                                            @error('productImage') 
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>                                            @error('image')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="">
                                                 <a href="" class=" mt-3 text-center">
                                                <button type="submit" class=" btn btn-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Update Product</button>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 ms-3 mt-3">
                                              <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input value="{{old('productName',$product->product_name)}}" id="cc-pament" name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product name...">
                                             @error('productName')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="productDescription"  cols="30" rows="10" class="form-control @error('productDescription') is-invalid @enderror">{{old('productDescription',$product->product_description)}}</textarea>
                                            @error('productDescription',$product->product_description) 
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                             <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="productCategory" class="form-control @error('productCategory') is-invalid @enderror">
                                                @foreach($categories as $c)
                                                    <option value="{{$c->id}}"  @if($product->product_category==$c->id) selected @endif>{{$c->category_name}}</option>
                                                @endforeach
                                            </select>
                                             @error('productCategory')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                             <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input value="{{old('productPrice',$product->product_price)}}" id="cc-pament" name="productPrice" type="text" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product price...">
                                             @error('productPrice')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input value="{{old('productWaitingTime',$product->waiting_time)}}" id="cc-pament" name="productWaitingTime" type="text" class="form-control @error('productWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product waiting time...">
                                             @error('productWaitingTime')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                           
                                        </div>
                                    </div>
                                  </form>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection