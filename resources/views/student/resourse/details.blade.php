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
                 <h4 class="ps-4">Resources</h4>
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

    <!-- resources programs start -->
    <div class="resources-programs">
        <div class="back">
            <a href="javascript:history.back()" class="text-white"><i class="fa-solid fa-arrow-left"></i></a>
         </div>
        
        <div class="resources-pdf py-4">
           <div class="pdf-image pb-4">
               <img src="{{ asset('/storage/' .$course->image) }}" alt="" />
           </div>
           <div class="downloads-plug"> 
           <div class="row">
            @foreach ($phase as $ph)
                <div class="col-lg-4 col-md-6">
                    <div class="downloads-box">
                        <h5>{{ $ph->title }}</h5>
                        <div class="d-flex justify-content-between">
                            <a href="#">Module {{ $loop->iteration }}</a>
                            <a href="{{ asset('storage/'.$ph->pdf_url) }}" download>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.6534 10.1711H13.3167L11.3609 12.1369C11.1908 12.3079 10.9357 12.4788 10.7656 12.5643C10.5105 12.6497 10.2554 12.7352 10.0003 12.7352C9.74522 12.7352 9.49012 12.6497 9.23502 12.5643C8.97992 12.4788 8.80985 12.3079 8.63978 12.1369L6.684 10.1711H2.34726C2.00713 10.1711 1.66699 10.4275 1.66699 10.8549V14.0173C1.66699 15.2138 2.60237 16.2395 3.79284 16.3249C5.57856 16.4959 8.04454 16.6668 10.0003 16.6668C11.9561 16.6668 14.4221 16.4959 16.2078 16.3249C17.3983 16.2395 18.3337 15.2138 18.3337 14.0173V10.8549C18.3337 10.513 17.9935 10.1711 17.6534 10.1711Z" fill="#0384FE"></path>
                                    <path d="M8.46971 10.1711L9.57515 11.2822C9.66019 11.3677 9.74522 11.3677 9.74522 11.4532C9.83026 11.4532 9.91529 11.5386 10.0003 11.5386C10.0854 11.5386 10.1704 11.5386 10.2554 11.4532C10.3405 11.4532 10.4255 11.3677 10.4255 11.2822L12.9765 8.71811C13.2316 8.4617 13.2316 8.03435 12.9765 7.77794C12.8064 7.69247 12.7214 7.607 12.5513 7.607C12.3813 7.607 12.2112 7.69247 12.1262 7.77794L10.6806 9.23093V4.01726C10.6806 3.67538 10.4255 3.3335 10.0003 3.3335C9.57515 3.3335 9.32005 3.67538 9.32005 4.01726V9.3164L7.87447 7.86341C7.78944 7.69247 7.61937 7.607 7.4493 7.607C7.27924 7.607 7.10917 7.69247 7.02413 7.86341C6.76903 8.11982 6.76903 8.54717 7.02413 8.80358L8.46971 10.1711Z" fill="#0384FE"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            </div>
            </div>
        </div>
    </div>
    <!-- resources programs end -->

</div>

@endsection