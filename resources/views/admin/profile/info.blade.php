@extends('../../layouts.category_master')
@section('content')
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                      <a href="{{route('category#list')}}" class="text-dark ms-4 mt-3">
                                    <div>
                                        <i class="fa-solid fa-left-long me-2"></i>Back
                                    </div>
                                </a>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account Profile Info</h3>
                                    </div>
                                    <hr>
                                     @if(session('msg'))
                                    <div class="mt-3 alert alert-success text-primary alert-dismissible fade show" role="alert">
                                        <strong>{{session('msg')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif
                                    <div class="row px-5 py-3">
                                        <div class="col-lg-4 text-end">
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
                                        </div>
                                        <div class="col-lg-7 offset-1 mt-3">
                                            <h4 class="mb-3">
                                                <i class="fa-solid fa-user me-2"></i> {{$user->name}}
                                            </h4>
                                             <h4 class="mb-3">
                                                <i class="fa-solid fa-envelope me-2"></i> {{$user->email}}
                                            </h4>
                                             <h4 class="mb-3">
                                               <i class="fa-solid fa-phone me-2"></i> {{$user->phone}}
                                            </h4>
                                             <h4 class="mb-3">
                                              <i class="fa-solid fa-location-dot me-2"></i> {{$user->address}}
                                            </h4>
                                             <h4 class="mb-3">
                                                <i class="fa-solid fa-calendar-days me-2"></i> {{$user->created_at->format('F-j-Y')}}
                                            </h4>
                                            <a href="{{route('admin#editProfilePage')}}" class="mt-3">
                                                <button class="btn btn-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection