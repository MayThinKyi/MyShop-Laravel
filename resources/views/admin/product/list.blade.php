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
                                        <h2 class="title-1">Product List</h2>

                                    </div>
                                </div>
                                <div class="table-data__tool-right ">
                                    <a href="{{route('product#createPage')}}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add Product
                                        </button>
                                    </a>
                                    <div class="my-3">
                                        <form action="{{route('product#list')}}" method="get">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" name="searchKey"  class="form-control" value="{{request('searchKey')}}" placeholder="Search Product...">
                                            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                     @if(session('updateSuccess'))
                                    <div class="mt-3 alert alert-success text-primary alert-dismissible fade show" role="alert">
                                        <strong>{{session('updateSuccess')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif
                                  @if(session('deleteSuccess'))
                                    <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{session('deleteSuccess')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif

                                </div>
                            </div>
                            
                                     @if (count($products))
                                       <div class="table-responsive table-responsive-data2 mb-3">
                                            <table class="table table-data2">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="col-lg-2">Product</th>
                                                        <th class="col-lg-1">Category</th>
                                                        <th class="col-lg-2">Name</th>
                                                        <th class="col-lg-2">Description</th>
                                                        <th class="col-lg-2">Price</th>
                                                        <th class="col-lg-2">Created At</th>
                                                       
                                                        <th class="col-lg-1">CRUD</th>
                                                        
                                                    </tr>
                                                </thead>
                                             <tbody>
                                            @foreach($products as $p)
                                            <tr class="tr-shadow text-center">
                                                <td class="col-lg-2">
                                                    <img src="{{asset('storage/'.$p->product_image)}}">
                                                </td>
                                                <td class="col-lg-1">{{$p->category_name}}</td>
                                                <td class="col-lg-2">{{$p->product_name}}</td>
                                                <td class="col-lg-2"> {{ Str::words($p->product_description, 5) }}</td>
                                                <td class="col-lg-2">{{$p->product_price}}</td>
                                                <td class="col-lg-2">{{$p->created_at->format('F-j-Y')}}</td>
                                                <td class="col-lg-1"> 
                                                    <div class="table-data-feature">
                                                    
                                                         <a href="{{route('product#readPage',$p->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                        </button>
                                                        </a>
                                                        <a href="{{route('product#editPage',$p->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        </a>
                                                    <a href="{{route('product#delete',$p->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                       @else
                                       <h3 class="text-dark">There is no data...</h3>  
                                      @endif
                                    </tbody>
                                </table>
                            </div>

                            {{$products->appends(request()->query())->links()}}
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection
