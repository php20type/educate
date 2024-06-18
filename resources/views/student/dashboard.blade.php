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
                 <h4 class="ps-4">Dashboard</h4>
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

    <!-- dashboard box section start -->
    <div class="dashboard-section">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                 <div class="dashboard-box mb-lg-4">
                     <a href="#">
                        <img class="comminty-image" src="{{ asset('img/home/join-comminty.png') }}" alt="" />
                     </a>
                 </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="dashboard-box monkmode mb-lg-4">
                     <div class="monkmode-sec mb-4">
                        <h5>Monk Mode</h5>
                        <div class="daycount-box text-center">
                            <h2>0</h2>
                            <h4>Day Streak</h4>
                            <p>21 Days Left</p>
                        </div>
                     </div>
                     <div class="bottom-icons">
                         <div class="icons-box">
                            <img src="img/home/icon1.png" alt="" />
                         </div>
                         <div class="icons-box">
                            <img src="img/home/icon2.png" alt="" />
                         </div>
                         <div class="icons-box">
                            <img src="img/home/icon3.png" alt="" />
                         </div>
                     </div>
                </div>
           </div>
           <div class="col-lg-5 col-md-6">
                <div class="dashboard-box">
                    <h5 class="sec-title">Coaching Today</h5>
                    <div class="call-list">
                        <p>No calls for today</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="dashboard-box">
                    <h5 class="sec-title">Resume where you left off</h5>
                     <div class="digital-don">
                         <img class="comminty-image" src="img/home/digital-icon.png" alt="" />
                     </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard box section start -->

</div>
@endsection
@section('page-script')

@endsection