@extends('layouts.app')

@section('content') 
    <!-- Register 2 section start -->
    <section class="ed-login-section">
      <div class="container-fluid px-0">
        <div class="row">
          <div class="col-lg-6">
            <div class="ed-login-form-sec">
              <div class="ed-login-box-sec">
                <div class="en-logo mb-5">
                  <a href="#" class="back">
                    <svg width="40" height="20" viewBox="0 0 40 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.66 8L12.82 2.82L10 0L0 10L10 20L12.82 17.18L7.66 12H40V8H7.66Z" fill="white"/>
                    </svg>
                  </a>
                  <a href="#" class="text-center d-block"><img src="img/logo/logo.svg" alt=""/></a>
                </div>
                <form class="ed-login-form mb-4" id="" method="POST" action="{{ route('register.postStep2') }}">
                  @csrf
                  <div class="form-group mb-4">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" placeholder="Liam" class="form-control"/>
                  </div>
                  @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
                  <div class="form-group mb-4">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" placeholder="John" class="form-control"/>
                  </div>
                  @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
                  <div class="form-group mb-4">
                    <label class="form-label w-100">Instagram</label>
                    <input
                      type="text" name="instagram" placeholder="@username (optinal)" class="form-control"/>
                  </div>
                   @error('instagram')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
                  <div class="form-group mb-4 otp-section" style="display: none">
                      <div class="otp-sec text-center"> 
                          <p>Please enter the verification code sent to your email address (check spam) :</p>
                          <div class="otp-round">
                              <input type="text" name="digit1" class="form-control" />
                              <input type="text" name="digit2" placeholder="" class="form-control" />
                              <input type="text" name="digit3" placeholder="" class="form-control" />
                              <input type="text" name="digit4" placeholder="" class="form-control" />
                              <input type="text" name="digit5" placeholder="" class="form-control" />
                              <input type="text" name="digit6" placeholder="" class="form-control" />
                          </div>
                      </div>
                      @error('text1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                      @enderror
                  </div> 
                  <div class="form-group">
                    <button type="button" id="sendOTP" value="" class="btn btn-outline-primary w-100">
                      Sign Up
                    </button>
                    <button type="submit" id="registerBtn" class="btn btn-outline-primary w-100" style="display: none;">Sign Up</button>
                  </div>
                </form>
                
                <div class="forget-password">
                  <p>Already have an account? <a href="#">Sign In</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 px-0">
            <div class="ed-login-image">
              <div class="left-image">
                <img src="img/home/left-image2.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Register 2 section end -->
@endsection
@section('page-script')
<script>
    $(document).ready(function() {
        $('#sendOTP').click(function() {
            $.ajax({
                url: "{{ route('send.otp') }}", // Define the route to send OTP
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: '{{ Session::get("registration.email") }}'
                },
                success: function(response) {
                    alert('OTP has been sent to your email.');
                    $('.otp-input').show(); // Show OTP input field
                    $('#sendOTP').hide(); // Hide Send OTP button
                    $('.otp-section').show();
                    $('#registerBtn').show(); // Show Register button
                },
                error: function(xhr) {
                    // Handle error
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection