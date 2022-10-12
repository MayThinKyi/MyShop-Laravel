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
                                        <h2 class="title-1">Order List</h2>

                                    </div>

                                </div>
                                <div class="table-data__tool-right ">


                                  @if(session('deleteSuccess'))
                                    <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{session('deleteSuccess')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif

                                </div>
                            </div>
                             <div class="row  mb-4 filterContainer">
                                   <div class="col-lg-7">
                                    <form class="" method="get" action="{{route('order#filterStatus')}}">
                                    @csrf
                                    <p class="mb-2">Order Status:</p>

                                    <div class="d-flex ">
                                         <select  name="filterStatus"  class="col-lg-4 form-control filterStatus">
                                            <option value="-1" @if(request('filterStatus')==-1) selected @endif >All</option>
                                            <option value="0" @if(request('filterStatus')==0) selected @endif >Pending</option>
                                            <option value="1" @if(request('filterStatus')==1) selected @endif>Accept</option>
                                            <option value="2" @if(request('filterStatus')==2) selected @endif>Reject</option>
                                         </select>
                                         <button type="submit" class="col-lg-3 btn btn-dark text-white filterBtn">Search</button>
                                    </div>
                                   </form>
                                </div>
                                <div class="col-lg-3 offset-2 mt-5">
                                    <button   type="button" class="p-2 px-3 d-flex btn btn-dark">
                                   <i class="fa-solid fa-database me-1 mt-1"></i>{{count($orders)}}
                                    </button>
                                    </div>
                                 </div>


                            @if(count($orders))
                                <div class="table-responsive table-responsive-data2 mb-3">
                                            <table class="table table-data2">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="col-lg-1">User ID</th>
                                                        <th class="col-lg-2">Username</th>
                                                        <th class="col-lg-3">Order Date</th>
                                                        <th class="col-lg-2">Order Code</th>
                                                        <th class="col-lg-1">Amount</th>
                                                        <th class="col-lg-3">Status</th>
                                                    </tr>
                                                </thead>
                                             <tbody>
                                            @foreach($orders as $o)
                                             <tr class="tr-shadow text-center">
                                                <input type="hidden" class="orderId" value="{{$o->id}}">
                                                <td class="col-lg-1">{{$o->user_id}}</td>
                                                <td class="col-lg-2">{{$o->user_name}}</td>
                                                <td class="col-lg-3">{{$o->created_at->format('F-j-Y')}}</td>
                                                 <td class="col-lg-2">
                                                      <a href="{{route('order#productInfo',$o->order_code)}}">{{$o->order_code}}
                                                </a>
                                                </td>
                                                <td class="col-lg-1">{{$o->total_price}} Kyats</td>
                                                <td class="col-lg-3">
                                                    <select name=""  class="form-control orderStatus">
                                                        <option value="0" @if($o->status==0) selected @endif>Pending</option>
                                                        <option value="1" @if($o->status==1) selected @endif>Accept</option>
                                                        <option value="2" @if($o->status==2) selected @endif>Reject</option>
                                                    </select>
                                                </td>

                                            </tr>
                                            <tr class="spacer"></tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                        </div>
                                    @else
                                <h3 class="fw-bold">There is no data...</h3>
                            @endif

                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection
@section('myScript')
<script>
    $(document).ready(function(){
        //Order List Table Status Change Function
        $('.orderStatus').change(function(){
            $orderId=$(this).parents('tr').find('.orderId').val();
           $changeStatus=$(this).parents('tr').find('.orderStatus').val();
           $data={
            'orderId':$orderId,
            'changeStatus':$changeStatus
           }
           $.ajax({
            type:'get',
            url:'/order/changeOrderStatus',
            data:$data,
            dataType:'json',
            success:function(response){
                if(response.msg=='success'){
                    window.location.href='http://127.0.0.1:8000/order/list';
                }
            }
           })
        })

    })
</script>
@endsection
