@extends('layouts.app')

@section('content')
@section('page-style')
<style>
  /* Loader CSS */
  .loader-container {
      display: none; /* Initially hide the loader */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
      z-index: 9999; /* Ensure the loader appears on top of other content */
  }

  .loader {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border: 8px solid #f3f3f3; /* Light grey border */
      border-top: 8px solid #3498db; /* Blue border */
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite; /* Apply rotation animation */
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }

</style>
@endsection
<!-- login section start -->
 <section class="ed-login-section">
     <div class="container-fluid px-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="ed-login-form-sec"> 
                <div class="ed-login-box-sec">
                    <div class="login mb-5">
                       <a href="#" class="text-center d-block"><img src="img/logo/logo.svg" alt="" /></a>
                    </div>
                    <form class="ed-login-form mb-4" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                 {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="form-group mb-4 otp-section" style="display: none">
                            <div class="otp-sec text-center"> 
                                <p>Please enter the verification code sent to your email address (check spam) :</p>
                                <div class="otp-round">
                                    <input type="text" name="digit1" class="form-control otp-input" maxlength="1" />
                                    <input type="text" name="digit2" class="form-control otp-input" maxlength="1" />
                                    <input type="text" name="digit3" class="form-control otp-input" maxlength="1" />
                                    <input type="text" name="digit4" class="form-control otp-input" maxlength="1" />
                                    <input type="text" name="digit5" class="form-control otp-input" maxlength="1" />
                                    <input type="text" name="digit6" class="form-control otp-input" maxlength="1" />
                                </div>
                            </div>
                            @error('text1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <button type="button" id="sendOTP" class="btn btn-outline-primary w-100">{{ __('Send OTP') }}</button>
                            <button type="submit" id="loginBtn" class="btn btn-outline-primary w-100" style="display: none;">{{ __('Sign In') }}</button>                        
                        </div>
                    </form>
                    <div class="forget-password">
                       <p>{{ __('New here?') }} <a href="{{ route('register') }}">{{ __('Create an account') }}</a></p>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-6 px-0">
                <div class="ed-login-image">
                    <div class="left-image"> 
                        <img src="img/home/left-image1.png" alt="" />
                     </div>
                </div>
            </div>
        </div>
     </div>
     <!-- Loader HTML -->
    <div id="loader" class="loader-container">
        <div class="loader"></div>
    </div>
</section>
@endsection
@section('page-script')
<script>
    $(document).ready(function() {
        $('#sendOTP').click(function() {
            $('#loader').show();
            let email = $('#email').val();
            $.ajax({
                url: "{{ route('send.otp') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email
                },
                success: function(response) {
                    $('#loader').hide();
                    toastr.success('OTP has been sent to your email.');
                    $('.otp-section').show();
                    $('#sendOTP').hide();
                    $('#loginBtn').show();
                },
                error: function(xhr) {
                    toastr.error('Failed to send OTP.');
                    console.log(xhr.responseText);
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', (event) => {
    const otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && index > 0 && input.value.length === 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
    });
</script>
@endsection