@extends('../../layouts.category_master')
@section('content')
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool col-lg-12">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">User List</h2>

                                    </div>
                                </div>
                                <div class="table-data__tool-right ">

                                    <div class="my-3">
                                        <form action="{{route('admin#adminList')}}" method="get">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" name="searchKey"  class="form-control" value="{{request('searchKey')}}" placeholder="Search Admin...">
                                            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                  @if(session('deleteSuccess'))
                                    <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{session('deleteSuccess')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif

                                </div>
                            </div>

                                        @if(count($users))
                                       <div class=" mb-3">
                                            <table class=" ">
                                                <thead >
                                                    <tr class="text-center ">
                                                        <th class="py-3 col-lg-2">Image</th>
                                                        <th class="py-3 col-lg-2">Name</th>
                                                        <th class="py-3 col-lg-1">Email</th>
                                                        <th class="py-3 col-lg-1">Gender</th>
                                                         <th class="py-3 col-lg-2">Phone</th>
                                                         <th class="py-3 col-lg-2">Address</th>
                                                        <th class="py-3 col-lg-2">Role</th>
                                                         <th class="py-3 col-lg-1"></th>
                                                    </tr>
                                                </thead>
                                             <tbody>

                                            @foreach($users as $u)
                                            <tr class="tr-shadow text-center   bg-light" style="font-size:14px;">
                                                 <input type="hidden" name="" id="userId" value="{{$u->id}}">
                                                <td class="col-lg-2 py-3 ">
                                                       @if ($u->image==null)
                                                        @if ($u->gender=='male')
                                                                <img style="width:150px" src="{{asset('storage/male_profile.jpg')}}"  />

                                                        @else
                                                        <img style="width:150px" src="{{asset('storage/female_profile.jpg')}}"  />

                                                        @endif
                                                    @else
                                                        <img style="width:150px" src="{{asset('storage/'.$u->image)}}"  />

                                                    @endif
                                                </td>


                                                <td class="col-lg-2 py-3 ">{{$u->name}} </td>
                                                <td class="col-lg-2 py-3 " style="margin:0 -20px">{{$u->email}}</td>
                                                <td class="col-lg-1 py-3 " style="padding-right: -20px">{{$u->gender}}</td>
                                                 <td class="col-lg-2 "  style="margin-left:-20px">{{$u->phone}} </td>
                                                 <td class="col-lg-1 ">{{$u->address}}</td>
                                                <td class="col-lg-2 py-3 ">
                                                   
                                                    <select name="" class="changeStatus ">
                                                        <option value="admin"> Admin</option>
                                                        <option value="user" selected>User</option>
                                                    </select>
                                                </td>
                                                <td class="col-lg-1  py-3" style="padding-right:-30px">
                                                <div class="table-data-feature">
                                                        <a href="{{route('user#delete',$u->id)}}">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                        </a>
                                                </div>
                                             </td>
                                             <tr class="spacer pb-3"></tr>
                                            </tr>
                                             
                                        @endforeach
                                       @else
                                       <h3 class="text-dark">There is no data...</h3>
                                      @endif

                                    </tbody>
                                </table>
                            </div>

                           {{--{{$admins->appends(request()->query())->links()}}--}}
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
    $('.changeStatus').change(function(){
      $userId=$(this).parents('tr').find('#userId').val();
      $changeStatusValue=$(this).val();
     $data={
        'userId':$userId,
        'changeStatusValue':$changeStatusValue
     };
     $.ajax({
        type:'get',
        url:'/userList/changeStatus',
        data:$data,
        dataType:'json',
        success:function(response){
            if(response.msg=='success'){
                location.reload();
            }
        }
     })
    })
   })
</script>
@endsection
