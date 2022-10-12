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
                                        <h2 class="title-1">Contact List</h2>

                                    </div>

                                </div>
                                <div class="table-data__tool-right ">


                                

                                </div>
                            </div>
                             <div class="row  mb-4 filterContainer">
                                  

                            @if(count($contacts))
                                <div class="table-responsive table-responsive-data2 mb-3">
                                            <table class="table table-data2">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="col-lg-1">ID</th>
                                                        <th class="col-lg-2">Name</th>
                                                        <th class="col-lg-3">Email</th>
                                                        <th class="col-lg-2">Subject</th>
                                                        <th class="col-lg-1">Message</th>
                                                        <th class="col-lg-3">Date</th>
                                                    </tr>
                                                </thead>
                                             <tbody>
                                            @foreach($contacts as $c)
                                             <tr class="tr-shadow text-center">
                                                <input type="hidden" class="orderId" value="{{$c->id}}">
                                                 <td class="col-lg-1">{{$c->id}}</td>
                                                <td class="col-lg-2">{{$c->name}}</td>
                                                <td class="col-lg-2">{{$c->email}}</td>
                                                <td class="col-lg-2">{{$c->subject}}</td>
                                                 <td class="col-lg-3">{{ Str::words($c->message, 10) }}
                                                </td>
                                                <td class="col-lg-2">{{$c->created_at->format('F-j-Y')}}</td>
                                              

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
   
</script>
@endsection
