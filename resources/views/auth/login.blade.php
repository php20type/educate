@extends('layouts.app')

@section('content')
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
                            <input type="email" id="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input class="form-check-input" type="radio" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                 {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" value="" class="btn btn-outline-primary w-100">{{ __('Sign In') }}</button>
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
</section>
@endsection