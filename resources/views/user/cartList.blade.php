@extends('../user/layouts/userMaster')
@section('content')


<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($carts as $c)
                       <tr>
                     <input type="hidden" class="userId" value="{{Auth::user()->id}}">
                       <input type="hidden" id="cartId" value="{{$c->id}}">

                            <td class="align-middle productName">{{$c->product_name}}</td>
                      <input type="hidden" class="productId" value="{{$c->product_id}}">

                            <td class="align-middle productPrice">{{$c->product_price}} Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn btnMinus">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text"  class="qty form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->quantity}}">
                                    <div class="input-group-btn btnPlus">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle " id='productTotal'>{{$c->product_price*$c->quantity}} Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger removeBtn"><i class="fa fa-times"></i></button></td>
                        </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 class="finalProductTotal">10000 Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 class="finalSummaryTotal">160 Kyats</h5>
                        </div>
                        <button class="rounded btn btn-block btn-primary font-weight-bold my-3 py-3 checkOutBtn">Proceed To Checkout</button>
                        <button class="rounded btn btn-block btn-danger font-weight-bold my-3 py-3 clearCartBtn">Clear Cart</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

   @endsection
   @section('myScript')
       <script>
        $(document).ready(function(){
            $totalVal=0;
              $('tbody tr').each(function(index,row){
                $totalVal+=Number($(row).find('#productTotal').text().replace(' Kyats',''))
              })
              $('.finalProductTotal').html($totalVal)
            $('.finalSummaryTotal').html($totalVal+3000+' Kyats')

            //When + Btn CLick
            $('.btnPlus').click(function(){

               $parentNode=$(this).parents('tr');
               $price=Number($parentNode.find('.productPrice').text().replace(' Kyats',''));
               $qty=Number($parentNode.find('.qty').val());
               $total=$parentNode.find('#productTotal');
              $total.html($price*$qty+' Kyats')
               $totalVal=0;
              $('tbody tr').each(function(index,row){
                $totalVal+=Number($(row).find('#productTotal').text().replace(' Kyats',''))
              })
              $('.finalProductTotal').html($totalVal)
            $('.finalSummaryTotal').html($totalVal+3000+' Kyats')

            });
            //When - Btn CLick
            $('.btnMinus').click(function(){

               $parentNode=$(this).parents('tr');
               $price=Number($parentNode.find('.productPrice').text().replace(' Kyats',''));
               $qty=Number($parentNode.find('.qty').val());
               $total=$parentNode.find('#productTotal');
              $total.html($price*$qty+' Kyats')
               $totalVal=0;
              $('tbody tr').each(function(index,row){
                $totalVal+=Number($(row).find('#productTotal').text().replace(' Kyats',''))
              })
              $('.finalProductTotal').html($totalVal)
            $('.finalSummaryTotal').html($totalVal+3000+' Kyats')

            });

            //When remove Btn click
            $('.removeBtn').click(function(){
             $cartId=$(this).parents('tr').find('#cartId').val();
               $(this).parents('tr').remove();
                $totalVal=0;
              $('tbody tr').each(function(index,row){
                $totalVal+=Number($(row).find('#productTotal').text().replace(' Kyats',''))
              })
              $('.finalProductTotal').html($totalVal)
            $('.finalSummaryTotal').html($totalVal+3000+' Kyats')
            
            $.ajax({
                type:'get',
                url:'/customer/clear/currentProduct',
                data:{'cartId':$cartId},
                dataType:'json',
                success:function(response){
                    if(response.msg=='success'){
                        window.location.href="http://127.0.0.1:8000/customer/cart/list";
                    }
                }

            })
            })
             $data=[];
        //When Preceed TO CHeck Out Btn CLick
        $('.checkOutBtn').click(function(){
             $data=[];
             $orderCode='POS'+ Math.floor((Math.random() * 10000000000) + 1);

            $parentNode=$(this).parents('tr');
            $('tbody tr').each(function(index,row){
               $userId=$(row).find('.userId').val();
               $productId=$(row).find('.productId').val();
               $qty=$(row).find('.qty').val();
               $productTotal=$(row).find('#productTotal').text().replace(' Kyats','');
              $data.push({
                'userId':$userId,
               'productId':$productId,
               'qty':$qty,
               'productTotal':$productTotal,
               'orderCode':$orderCode
            });
            })
            $.ajax({
                type:'get',
                url:'/ajax/orderList',
                data:Object.assign({}, $data),
                dataType:'json',
                success:function(response){
                    if(response.status=='success'){
                        window.location.href="http://127.0.0.1:8000/customer/home";
                    }
                }

            })
           
        })
        //Clear Cart Function
        $('.clearCartBtn').click(function(){
           $('tbody tr').each(function(index,row){
            $(row).remove();
           })
           $.ajax({
            type:'get',
            url:'/customer/clear/cart',
            data:{'userId':{{Auth::user()->id}}},
            dataType:'json',
            success:function(response){
                if(response.msg=='success'){
                    window.location.href="http://127.0.0.1:8000/customer/cart/list";
                }
            }
           })
          
        })
        


        })
       </script>
   @endsection

