@extends('../user/layouts/userMaster')
@section('content')



    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Categories</span></h5>
                <div class="bg-light py-4 px-1 mb-30">
                   <div class="col-lg-12">
                    <div   class="bg-dark text-white p-3 d-flex justify-content-between">
                    <span> Categories</span>
                    <span class="ms-3  badge " style="font-size: 16px;border:1px solid white">{{count($categories)}}</span>
                    </div>
                <div class="mt-3">
                    <a href="{{route('customer#home')}}" style="font-size:17px;font-weight:500"  class="ms-2   text-dark text-decoration-none">
                    All
                </a>
                </div>
                <hr>

                    @foreach ($categories as $c)
                       <a href="{{route('filter#category',$c->id)}}"  class="text-decoration-none">
                        
                         <div class="my-3 text-dark">
                            {{$c->category_name}}
                        </div>
                       </a>
                    @endforeach
                </div>
                </div>
                <!-- Price End -->
                

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                               <a href="{{route('cart#list')}} " >
                                 <button type="button" class="mb-2 mb-md-0 rounded btn btn-warning position-relative">
                                   <i class="text-white fa-solid fa-cart-shopping"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{count($carts)}}
                                      
                                    </span>
                                </button>
                               </a>
                               <a class="ms-0 ms-lg-2 " href="{{route('customer#orderHistory')}}">
                                 <button type="button" class="py-2 rounded btn btn-warning position-relative">
                                  <i class="text-white fa-solid fa-clock-rotate-left "></i> <span class="text-white">Order History</span>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{count($orders)}}
                                      
                                    </span>
                                </button>
                               </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select class="form-control sortingBtn" name="" id="">
                                        <option value="">Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                     <div id="productList" class="row mx-auto">
                         @if(count($products))
                          @foreach($products as $p)
                     
                         <div class="col-lg-4  col-md-6 col-sm-6 pb-1">
                            
                            <div class="product-item rounded-lg bg-light mb-4">
                                <div class="product-img  position-relative overflow-hidden">
                                    <img class="" style="height:220px;width:100%;object-fit:cover" src="{{asset('storage/'.$p->product_image)}}" alt="">
                                    <div class="product-action">
                               
                                <a class="btn btn-outline-dark btn-square" href="{{route('customer#detail',$p->id)}}"> <i class="fa-solid fa-eye "></i></a>
                            </div> 
                                </div>
                                <div class="text-center  py-4">
                                    <a class="h6 text-decoration-none text-truncate"  href="{{route('customer#detail',$p->id)}}">{{$p->product_name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$p->product_price}}</h5><h6 class="text-muted ml-2">Kyats</h6>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                      
                       @endforeach
                         @else
                         <h5>There is no data...</h5>
                         @endif
                         
                     </div>
                    </a>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
   @endsection
   @section('myScript')
       <script>
          
        $(document).ready(function(){
            
            $('.sortingBtn').change(function(){
               $sortingValue=$('.sortingBtn').val();
               
               if($sortingValue=='asc'){
                 $list='';
                 $.ajax({
                type:'get',
                url:'/ajax/sorting',
                data:{'status':'asc'},
                dataType:'json',
               
                success:function(response){
                   $list='';
                   for($i=0;$i<response.products.length;$i++){
                    $list+= ` 
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                             
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height:220px" src="{{asset('storage/${response.products[$i].product_image}')}}" alt="">
                                    <div class="product-action">
                               
                                <a class="btn btn-outline-dark btn-square" href=""> <i class="fa-solid fa-eye "></i></a>
                            </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"  href="">${response.products[$i].product_name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response.products[$i].product_price}</h5><h6 class="text-muted ml-2">Kyats</h6>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                    `;
                   }
                  
                  $('#productList').html($list);

                }
            })
            }
         if($sortingValue=='desc'){
                 $list='';
                 $.ajax({
                type:'get',
                url:'/ajax/sorting',
                data:{'status':'desc'},
                dataType:'json',
               
                success:function(response){
                   $list='';
                   for($i=0;$i<response.products.length;$i++){
                    $list+= ` 
                     <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                             
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height:220px" src="{{asset('storage/${response.products[$i].product_image}')}}" alt="">
                                    <div class="product-action">
                               
                                <a class="btn btn-outline-dark btn-square" href=""> <i class="fa-solid fa-eye "></i></a>
                            </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"  href="">${response.products[$i].product_name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response.products[$i].product_price}</h5><h6 class="text-muted ml-2">Kyats</h6>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                    `;
                   }
                   
                  $('#productList').html($list);
                  
                   
                  
                   
                

                }
               })
               }

        })
    })
       </script>
   @endsection

