@extends('../user/layouts/userMaster')
@section('content')


<!-- Cart Start -->
    <div class="container-fluid ">
        <div class="row px-xl-5 ">
            <div class="col-lg-8 table-responsive mb-5 mx-auto">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                         
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($orders as $o)
                       <tr>
                     <input type="hidden" class="userId" value="{{Auth::user()->id}}">

                            <td class="align-middle ">{{$o->created_at->format('F-j-Y')}}</td>
                            <td class="align-middle ">{{$o->order_code}}</td>
                             <td class="align-middle ">{{$o->total_price}} Kyats</td>
                              <td class="align-middle ">
                                @if($o->status==0)
                                 <div class="text-warning">
                                       <i class="fa-regular fa-hourglass-half me-1"></i>Pending...
                                 </div>
                                @elseif($o->status==1)
                                 <div class="text-success">
                                      <i class="fa-solid fa-check me-1"></i>Success...
                                 </div>
                                  @elseif($o->status==2)
                                 <div class="text-danger">
                                     <i class="fa-solid fa-xmark me-1"></i>Reject...
                                 </div>
                                       
                                @endif
                              </td>
                           
                        </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
            {{$orders->appends(request()->query())->links()}}
          
        </div>
    </div>
    <!-- Cart End -->

   @endsection
   @section('myScript')
       <script>
      
       </script>
   @endsection

