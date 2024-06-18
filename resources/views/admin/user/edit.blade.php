@extends('layouts.app')

@section('content')
@include('admin.aside-menu')
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
                    <h4>User Management</h4>
                 </div>
                </div>
            </div>
           <div class="top-header-rightmenu">
            <form class="search-bar position-relative me-2" id="" accept="">
                <input type="text" name="" id="" placeholder="Type Here..." class="form-control">
                <i class="fa-regular fa-magnifying-glass"></i>
            </form>
            @include('admin.header')
           </div>
            
        </div>
    </div>
    <!-- header end -->

  <!-- profile section start -->
  <div class="profile-section">
     @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <div class="profile-info">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex">
                    <div class="profile-image">
                         <img src="{{ asset('img/home/profile.png') }}" alt="" />
                    </div>
                    <div class="name-details">
                        <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                        <p>{{ $user->email }}</p>
                        <p>Student ID: {{ $user-3>id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
 
    <div class="profile-form">
        <form id="" action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="row">
                 <div class="col-lg-6 col-md-6">
                      <div class="form-group mb-4">
                            <label class="form-label w-100">First Name</label>
                            <input type="text" name="first_name" placeholder="Liam" class="form-control" value="{{ $user->first_name }}" />
                      </div>
                 </div>
                 <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-4">
                          <label class="form-label w-100">Last Name</label>
                          <input type="text" name="last_name" placeholder="John" class="form-control" value="{{ $user->last_name }}"/>
                    </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="form-group mb-4">
                      <label class="form-label w-100">Email Address</label>
                      <input type="text" name="email" disabled ="master@magicfp.com" class="form-control" value="{{ $user->email }}"/>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group mb-4">
                    <label class="form-label w-100">Phone Number</label>
                    <input type="text" name="phone" placeholder="(+012) 345 6789" class="form-control" value="{{ $user->phone }}" />
                </div>
            </div>
             <div class="col-lg-6 col-md-6">
                <div class="form-group mb-4">
                    <label class="form-label w-100">Status</label>
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option value="0" {{ $user->is_active  == 0 ? 'selected' : '' }}>Inactive</option>
                        <option value="1" {{ $user->is_active  == 1 ? 'selected' : '' }}>Active</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group mb-4">
                    <label class="form-label w-100">Plan</label>
                    <select class="form-select" name="plan" aria-label="Default select example">
                        <option value="0" {{ $user->is_active  == 0 ?  'selected' : '' }}>Premium</option>
                        <option value="1" {{ $user->is_active  == 1 ? 'selected' : '' }}>Basic</option>
                    </select>
                </div>
            </div>
            </div>
             <div class="col-lg-12">
                <div class="save-btn pt-lg-3 pt-2 text-lg-center">
                    <button type="submit" class="btn btn-outline-primary">Save & Continue</button>
                     <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">Cancel</a>
                </div>
                {{-- <div class="save-btn pt-lg-5 pt-4 text-lg-end">
                   
                </div> --}}
            </div>
        </form>
    </div>
</div>
<!-- profile section end -->

</div>
@endsection