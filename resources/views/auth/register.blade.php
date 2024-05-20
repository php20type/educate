@extends('layouts.app')

@section('content')
<!-- Register section start -->
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
                            <a href="#" class="text-center d-block">
                                <img src="img/logo/logo.svg" alt="" />
                            </a>
                        </div>
                        <form class="ed-login-form mb-4" method="POST" action="{{ route('register.postStep1') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="confirm_email" class="form-label">{{ __('Confirm Email') }}</label>
                                <input id="confirm_email" type="email" placeholder="Confirm Email Address" class="form-control @error('confirm_email') is-invalid @enderror" name="confirm_email" required autocomplete="new-email">
                                @error('confirm_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                                <input id="phone" type="text" placeholder="Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary w-100">{{ __('Next') }}</button>
                            </div>
                        </form>
                        <div class="forget-password">
                            <p>{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Sign In') }}</a></p>
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
<script defer>
    const phoneInputField = document.querySelector("#phone");
    if (phoneInputField) {
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    }
</script>
@endsection
