@extends('../user/layouts/userMaster')
@section('content')
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       
                        <div class="col-12  col-lg-10 mx-auto">
                            <div class="card">

                                <a href="{{route('customer#home')}}" class="text-dark ms-4 mt-3">
                                    <div>
                                        <i class="fa-solid fa-left-long me-2"></i>Back
                                    </div>
                                </a>
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account  Profile </h3>
                                    </div>
                                    <hr>
                                     @if(session('updateSuccess'))
                                    <div class="mt-3 alert alert-success text-primary alert-dismissible fade show" role="alert">
                                        <strong class="text-primary text-primary">{{session('updateSuccess')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif
                                  <form action="{{route('customer#updateProfile')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                      <div class="row px-lg-5 px-0 py-3">
                                        <div class="col-lg-4 text-center userAccountImg" >
                                            @if ($user->image==null)
                                                @if ($user->gender=='male')
                                                     <img  class="rounded-pill"  src="{{asset('storage/male_profile.jpg')}}" alt="">
                                                @else
                                                     <img  class="rounded-pill" src="{{asset('storage/female_profile.jpg')}}" alt="">

                                                @endif
                                            @else
                                                <img  class="rounded-pill" style="width:250px" src="{{asset('storage/'.$user->image)}}" alt="">
                                            @endif
                                           
                                            <input type="file" class=" mt-3 form-control @error('image') is-invalid @enderror" name="image" id="">
                                            @error('image')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="mt-4">
                                                 <a href="" class=" mt-3 text-center">
                                                <button type="submit" class=" btn btn-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Update Profile</button>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 offset-lg-1 mt-3">
                                            <div class="mb-2">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}">
                                            </div>
                                             <div class="mb-2">
                                                <label for="">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{old('email',$user->email)}}">
                                            </div>
                                             <div class="mb-2">
                                                <label for="">Phone Number</label>
                                                <input type="text" class="form-control" name="phone" value="{{old('phone',$user->phone)}}">
                                            </div>
                                             <div class="mb-2">
                                                <label for="">Address</label>
                                                <textarea name="address" id="" cols="30" rows="10" class="form-control"> {{old('address',$user->address)}}
                                                </textarea>
                                            </div>
                                             <div class="mb-2">
                                                <label for="">Gender</label>
                                               <select class="form-control" name="gender" id="" >
                                                <option value="male" @if(Auth::user()->role=='admin') selected @endif >Male</option>
                                                <option value="female" @if(Auth::user()->role=='user') selected @endif >Female</option>
                                               </select>
                                            </div>
                                             <div class="mb-2">
                                                <label for="">Role</label>
                                               <select class="form-control" name="role" id="" disabled>
                                                <option value="admin" >Admin</option>
                                                <option value="user" selected>User</option>
                                               </select>
                                            </div>
                                           
                                        </div>
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