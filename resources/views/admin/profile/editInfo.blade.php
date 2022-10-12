@extends('../../layouts.category_master')
@section('content')
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       
                        <div class="col-lg-12">
                            <div class="card">
                                <a href="javascript:history.back()" class="text-dark ms-4 mt-3">
                                    <div>
                                        <i class="fa-solid fa-left-long me-2"></i>Back
                                    </div>
                                </a>
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account Edit Profile Info</h3>
                                    </div>
                                    <hr>
                                  <form action="{{route('admin#updateProfile')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                      <div class="row px-5 py-3">
                                        <div class="col-lg-4 text-center">
                                            @if ($user->image==null)
                                                @if ($user->gender=='male')
                                                     <img  class="rounded-pill"  src="{{asset('storage/male_profile.jpg')}}" alt="">
                                                @else
                                                     <img  class="rounded-pill" src="{{asset('storage/female_profile.jpg')}}" alt="">

                                                @endif
                                            @else
                                                <img  class="rounded-pill" src="{{asset('storage/'.$user->image)}}" alt="">
                                            @endif
                                            <img src="" alt="">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="">
                                            @error('image')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                            <div class="">
                                                 <a href="" class=" mt-3 text-center">
                                                <button type="submit" class=" btn btn-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Update Profile</button>
                                            </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 offset-1 mt-3">
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
                                                <option value="admin" selected>Admin</option>
                                                <option value="user" >User</option>
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