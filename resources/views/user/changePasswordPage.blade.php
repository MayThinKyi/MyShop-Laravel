@extends('../user/layouts/userMaster')
@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content " style="margin-top:-30px">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6  offset-lg-3 mt-4">
                            <div class="card">
                                <div class="card-body">
                                     @if(session('changePwSuccess'))
                                    <div class="mt-3 alert alert-success text-primary alert-dismissible fade show" role="alert">
                                        <strong class="text-primary text-primary">{{session('changePwSuccess')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif
                                     @if(session('oldPwError'))
                                    <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{session('oldPwError')}}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                  @endif
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('customer#changePassword')}}" method="post" >
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                            <input  id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false " placeholder="Enter your old password...">
                                             @error('oldPassword')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                                            <input  id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your new password...">
                                             @error('newPassword')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                            <input  id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your confirm password...">
                                             @error('confirmPassword')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Change Password</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
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