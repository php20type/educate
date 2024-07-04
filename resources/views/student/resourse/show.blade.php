@extends('layouts.app')

@section('page-style')
<style>
</style>
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
                 <h4 class="ps-4">Resources</h4>
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

    <!-- resources programs start -->
    <div class="resources-programs">
        <div class="back">
            <a href="#" class="text-white"><i class="fa-solid fa-arrow-left"></i></a>
         </div>
        
        <div class="resources-pdf py-4">
           <div class="pdf-image pb-4">
               <img src="{{ asset('/storage/'.$program->image) }}" alt="" />
           </div>
           <div class="downloads-plug"> 
           <div class="row">
            @foreach ($course as $cs)
            <div class="col-lg-6 col-md-6">
                <div class="downloads-box rs-phase-box">
                    <div class="rs-phase-left-sec">
                        <h2>{{ $cs->title }}</h2>
                         <p>{{ $cs->description }}</p>
                    </div>
                    <div class="rs-phase-right-sec">
                        <h1>1</h1>
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

@section('page-script')
<script>
</script>
@endsection    