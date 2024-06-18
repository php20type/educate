@extends('layouts.app')

@section('page-style')

@endsection

@section('content')
@include('student.aside-menu')

<div class="main-content app-content">
    <!-- header start -->
    <div class="header">
        <div class="header-content">
            <div class="sidemenu-toggle"> 
                <div class="d-flex align-items-center"> 
                <a href="javascript:void(0)" id="menu-toggle">
                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="44" height="44" rx="9" fill="#4DA6FF" fill-opacity="0.15" stroke="#4DA6FF" stroke-width="2"/>
                        <rect x="13" y="14" width="10" height="3" rx="1.5" fill="#4DA6FF"/>
                        <rect x="13" y="21" width="20" height="3" rx="1.5" fill="#4DA6FF"/>
                        <rect x="23" y="28" width="10" height="3" rx="1.5" fill="#4DA6FF"/>
                    </svg>                        
                 </a>
                 <div class="d-block ps-4">
                    <p>Dashboard</p>
                    <h4>Profile</h4>
                 </div>
               
                </div>
            </div>
           <div class="top-header-rightmenu">
            <form class="search-bar position-relative me-2" id="" accept="">
                <input type="text" name="" id="" placeholder="Type Here..." class="form-control">
                <i class="fa-regular fa-magnifying-glass"></i>
            </form>
            @include('student.header')
           </div>
            
        </div>
    </div>
    <!-- header end -->

    <!-- profile section start -->
    <div class="profile-section">
        <div class="sec-title">
            <h4>My Profile</h4>
        </div>
        <div class="cover-images">
            <img src="{{ asset('img/home/cover.png') }}" alt="" />
        </div>
        <div class="profile-info">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-flex">
                        <div class="profile-image">
                             <img src="{{ asset('img/home/profile.png') }}" alt="" />
                        </div>
                        <div class="name-details">
                            <h4>{{ auth()->user()->first_name }}{{ auth()->user()->last_name }}</h4>
                            <p>{{ auth()->user()->email }}</p>
                            <p>{{ auth()->user()->id }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="save-btn pt-5 text-end">
                         <a href="#" class="btn btn-outline-primary">Save & Continue</a>
                    </div>
                </div>
            </div>
        </div>  
        <div class="profile-form mb-4">
            <form id="" accept="">
                <div class="row">
                     <div class="col-lg-4 col-md-6">
                          <div class="form-group mb-4">
                                <label class="form-label w-100">Country</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>United States</option>
                                    <option value="1">India</option>
                                    <option value="2">England</option>
                                    <option value="3">Spain</option>
                                </select>
                          </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="form-group mb-4">
                              <label class="form-label w-100">City</label>
                              <select class="form-select" aria-label="Default select example">
                                  <option selected>Abberton</option>
                                  <option value="1">India</option>
                                  <option value="2">England</option>
                                  <option value="3">Spain</option>
                              </select>
                        </div>
                   </div>
                   <div class="col-lg-4 col-md-6">
                      <div class="form-group mb-4">
                          <label class="form-label w-100">Date of Birth (DD-MM-YYYY)</label>
                          <input type="number" placeholder="" class="form-control" />
                      </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-4">
                        <label class="form-label w-100">About Me</label>
                       <textarea rows="4" placeholder="" class="form-control"></textarea>
                    </div>
                 </div>
                 <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-4">
                        <label class="form-label w-100">Link Your Socials</label>
                        <input type="text" placeholder="Educate Community Profile Link" class="form-control mb-3" />
                        <input type="text" placeholder="Instagram Profile Link" class="form-control mb-3" />
                        <input type="text" placeholder="Twitter Profile Link" class="form-control" />
                    </div>
                </div>
                </div>
            </form>
        </div>
        <div class="profile-form">
            <form id="" accept="">
                <div class="row">
                     <div class="col-lg-6 col-md-6">
                          <div class="form-group mb-4">
                                <label class="form-label w-100">First Name</label>
                                <input type="text" placeholder="Liam" class="form-control" />
                          </div>
                     </div>
                     <div class="col-lg-6 col-md-6">
                        <div class="form-group mb-4">
                              <label class="form-label w-100">Last Name</label>
                              <input type="text" placeholder="John" class="form-control" />
                        </div>
                   </div>
                   <div class="col-lg-12 col-md-12">
                      <div class="form-group mb-4">
                          <label class="form-label w-100">Email Address</label>
                          <input type="text" placeholder="master@magicfp.com" class="form-control" />
                      </div>
                  </div>
                 <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-4">
                        <label class="form-label w-100">Time Zone</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Europe/Madrid</option>
                            <option value="1">India</option>
                            <option value="2">England</option>
                            <option value="3">Spain</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-4">
                         <button type="button" class="btn btn-outline-primary w-100 py-3">Save</button>
                     </div>
                </div>
                </div>
            </form>
        </div>
    </div>
    <!-- profile section end -->

</div>

@endsection
@section('page-script')
    <script defer>
        const phoneInputField = document.querySelector("#phone");
        if (phoneInputField) {
            const phoneInput = window.intlTelInput(phoneInputField, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            // Attach the form submit event handler
        }
    </script>
@endsection
