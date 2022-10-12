@extends('../user/layouts/userMaster')
@section('content')
<a class="m-5 " href="{{route('customer#home')}}">
    <button class="rounded btn btn-dark text-white"><i class="fa-solid fa-left-long me-1"></i>Back</button>

</a>
<!-- Shop Detail Start -->
    <div class="container-fluid pb-5 mt-4">
        <div class="row px-xl-5">
            <div class="col-lg-5  mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner ">
                        <div class="carousel-item active">
                            <img style="height:400px;" src="{{asset('storage/'.$product->product_image)}}" alt="Image">
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="product h-100 bg-light p-30">
                     <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                    <input type="hidden" id="productId" value="{{$product->id}}">
                    <h3>{{$product->product_name}}</h3>
                    <div class="d-flex mb-3">
                       <i class="fa-solid fa-eye mt-1 me-1"></i> <p class="viewCount">{{$product->view_count}}</p> Views

                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$product->product_price}} Kyats</h3>
                    <p class="mb-4">{{$product->product_description}}</p>
                    <div class="d-flex flex-wrap align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-lg-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="qty" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button"  class="btn btn-primary px-3 addToCartBtn mt-2 ms-sm-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                   @foreach($products as $p)

                    <div class="product-item bg-light">
               <a href="{{route('customer#detail',$p->id)}}">

                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height:250px " src="{{asset('storage/'.$p->product_image)}}" alt="">
                           <div class="product-action">

                                <a class="btn btn-outline-dark btn-square" href="{{route('customer#detail',$p->id)}}"> <i class="fa-solid fa-eye "></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{route('customer#detail',$p->id)}}">{{$p->product_name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$p->product_price}} Kyats</h5>
                            </div>

                        </div>
                    </a>
                    </div>
                   @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('myScript')
    <script>
        $(document).ready(function(){
            //View COunt Function
            $viewCount=Number($('.viewCount').text())+1;
            $productId=$('#productId').val();
            $.ajax({
                type:'get',
                url:'/ajax/viewCount',
                data:{'viewCount':$viewCount,'productId':$productId},
                dataType:'json',
                success:function(){

                }
            })
            $('.viewCount').html($viewCount);
            $('.addToCartBtn').click(function(){
                $userId=$(this).parents('.product').find('#userId').val();
                $productId=$(this).parents('.product').find('#productId').val();
                $qty=$(this).parents('.product').find('#qty').val();
                $data={
                    'userId':$userId,
                    'productId':$productId,
                    'qty':$qty
                };
                $.ajax({
                    type:'get',
                    url:'/customer/add/cart',
                    data:$data,
                    dataType:'json',
                    success:function(response){
                       if(response.msg='success'){
                        window.location.href="http://127.0.0.1:8000/customer/home";
                       }
                    }
                })
            })
        })
    </script>
@endsection
