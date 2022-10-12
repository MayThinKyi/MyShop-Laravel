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
                                        <h2 class="title-1">Admin List</h2>

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
                            
                                     @if (count($admins))
                                       <div class="table-responsive table-responsive-data2 mb-3">
                                            <table class="table table-data2">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="col-lg-2">Image</th>
                                                        <th class="col-lg-2">Name</th>
                                                        <th class="col-lg-2">Email</th>
                                                        <th class="col-lg-1">Gender</th>
                                                         <th class="col-lg-2">Address</th>
                                                        <th class="col-lg-3"></th>
                                                        
                                                    </tr>
                                                </thead>
                                             <tbody>
                                            @foreach($admins as $a)
                                            <tr class="tr-shadow text-center">
                                                <td class="col-lg-2">
                                                       @if ($a->image==null)
                                                        @if ($a->gender=='male')
                                                                <img src="{{asset('storage/male_profile.jpg')}}"  />

                                                        @else
                                                        <img src="{{asset('storage/female_profile.jpg')}}"  />

                                                        @endif
                                                    @else
                                                        <img src="{{asset('storage/'.$a->image)}}"  />

                                                    @endif    
                                                </td>
                                                 

                                                <td class="col-lg-2">{{$a->name}} </td>
                                                <td class="col-lg-2">{{$a->email}}</td>
                                                <td class="col-lg-1">{{$a->gender}}</td>
                                                 <td class="col-lg-2">{{$a->address}}</td>
                                                <td class="col-lg-3">
                                                    <input type="hidden" name="" id="adminId" value="{{$a->id}}"> 
                                                    <div class="table-data-feature">
                                                       <div class="@if(Auth::user()->id==$a->id) d-none @endif" >
                                                       <select  class="form-control changeRoleOption" >
                                                        <option value="admin" selected>Admin</option>
                                                        <option value="user">User</option>
                                                       </select>
                                                       </div>
                                                        <a href="{{route('category#editPage',$a->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        </a>
                                                    <a href="{{route('category#delete',$a->id)}}">
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

                            {{$admins->appends(request()->query())->links()}}
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
      $('.changeRoleOption').change(function(){
        $changeRoleOption=$(this).val();
        $adminId=$(this).parents('tr').find('#adminId').val();
       $data={
        'id':$adminId,
        'role':$changeRoleOption
       };
       $.ajax({
        type:'get',
        url:'/profile/admin/changeRole',
        data:$data,
        dataType:'json',
        success:function(response){
            if(response.status='success'){
                  window.location.reload();
            }
        }
       })
      })
    })
</script>
@endsection
