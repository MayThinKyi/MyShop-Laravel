@extends('../user/layouts/userMaster')
@section('content')

 <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form method="post" action='{{route('customer#contact')}}' >
                        @csrf
                        <div class="control-group mb-4">
                            <input name="userName" type="text" class="form-control @error('userName') is-invalid @enderror" id="name" placeholder="Your Name"
                               value="{{old('userName')}}"  data-validation-required-message="Please enter your name" />
                           
                             @error('userName')
                            <small class='text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="control-group mb-4">
                            <input name="userEmail" type="email" class="form-control @error('userEmail') is-invalid @enderror" id="email" placeholder="Your Email"
                              value="{{old('userEmail')}}"    data-validation-required-message="Please enter your email" />
                          
                             @error('userEmail')
                            <small class='text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="control-group mb-4">
                            <input name="userSubject" type="text" class="form-control @error('userSubject') is-invalid @enderror" id="subject" placeholder="Subject"
                              value="{{old('userSubject')}}"   data-validation-required-message="Please enter a subject" />
                           
                             @error('userSubject')
                            <small class='text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="control-group mb-4">
                            <textarea name="userMessage" class="form-control @error('userMessage') is-invalid @enderror" rows="8" id="message" placeholder="Message"
                               
                              value="{{old('userMessage')}}"   data-validation-required-message="Please enter your message"></textarea>
                           
                            @error('userMessage')
                            <small class='text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" >Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->



  
@endsection
@section('myScript')
    <script>
      
    </script>
@endsection
