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
                 <h4 class="ps-4">Programs</h4>
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

    <!-- programs section start -->
    <div class="programs-section">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ChapterModal"><img src="{{ asset('img/home/1.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ asset('img/home/2.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ asset('img/home/3.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ asset('img/home/4.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ asset('img/home/5.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ asset('img/home/6.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ asset('img/home/7.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ ('img/home/8.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ ('img/home/9.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ ('img/home/10.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ ('img/home/11.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ ('img/home/12.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="program-box">
                    <a href="#"><img src="{{ ('img/home/13.png') }}" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    <!-- programs section start -->

</div>

<!-- exampleModal start -->
 <div class="modal fade" id="ChapterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header border-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <div class="chapter-sec">
                 <img class="mb-4" src="{{ ('img/home/1003953.png') }}" alt="" />
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus ac ex nec ultricies. Aliquam egestas tortor sit amet dui ullamcorper, vitae ornare leo lobortis. Fusce pretium mi urna, sed eleifend dui euismod vel. Fusce faucibus metus lorem. Maecenas lectus dui, scelerisque at lorem a, tempus facilisis purus. Sed varius consectetur arcu et ullamcorper.</p>
            </div>
            <div class="phases-sec">
                <p>Phases:</p>  
                <div class="phases-image">
                    <div class="row">
                        <div class="col-md-3 col-6">
                            <a href="#"><img src="{{ ('img/home/103956.png') }}" /></a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="#"><img src="{{ ('img/home/103956.png') }}" /></a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="#"><img src="{{ ('img/home/103956.png') }}" /></a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="#"><img src="{{ ('img/home/103956.png') }}" /></a>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- exampleModal end -->
  @endsection
@section('page-script')

@endsection