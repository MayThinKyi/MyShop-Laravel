@extends('../../layouts.category_master')
@section('content')
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Create Product</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('product#create')}}" enctype="multipart/form-data" method="post" >
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input value="{{old('productName')}}" id="cc-pament" name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product name...">
                                             @error('productName')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="productDescription"  cols="30" rows="10" class="form-control @error('productDescription') is-invalid @enderror">{{old('productDescription')}}</textarea>
                                            @error('productDescription') 
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                          <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Image</label>
                                           <input  type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror">
                                            @error('productImage') 
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                           <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="productCategory" class="form-control @error('productCategory') is-invalid @enderror">
                                                @foreach($categories as $c)
                                                    <option value="{{$c->id}}">{{$c->category_name}}</option>
                                                @endforeach
                                            </select>
                                             @error('productCategory')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                           <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input value="{{old('productPrice')}}" id="cc-pament" name="productPrice" type="text" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product price...">
                                             @error('productPrice')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input value="{{old('productWaitingTime')}}" id="cc-pament" name="productWaitingTime" type="text" class="form-control @error('productWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product waiting time...">
                                             @error('productWaitingTime')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Create Product</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection