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
                    <h4>Program Management</h4>
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
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- edit program start -->
    <div class="program-edit">
        <form class="mb-5" id="program-form" action="{{ route('programs.update', $program->id) }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            @method('PUT')
            <div class="form-group position-relative mb-4">
                <div class="image-box"> 
                    <img src="{{ asset('storage/' . $program->image) }}" alt="" id="preview-image" />
                </div>
                <div class="edit-btn add-new">
                    <a href="#" class="btn remove">Remove Image</a>
                    <a href="#" class="btn change">Change Image</a>
                </div>
            </div>
            <div class="form-group mb-4">
                <label class="form-label">Program Name</label>
                <input name="name" type="text" placeholder="Type here..." class="form-control" value="{{ $program->name }}" required/>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label class="form-label">Description</label>
                <textarea rows="6" name="description" class="form-control" placeholder="Type here..." required>{{ $program->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                 <button type="submit" class="btn btn-outline-primary">Save & Continue</button>
            </div>
     </form>
     <!-- edit program end -->

     <!-- Add chapter in program start -->

     <div class="image-list">
        @foreach ($course as $cs)
        <div class="image-box">
            <a href="{{ route('courses.edit', $cs->id) }}" class="d-flex flex-column">
                <img src="{{ isset($cs->image) ? asset('storage/'.$cs->image) : asset('img/home/rec1254.png') }}" alt="" />
                <p><b>{{ $cs->title }}</b></p>
            </a>    
        </div>
        @endforeach
        <div class="image-box">
            <div class="border-dash">
                <a href="{{ route('courses.create', $program->id) }}" class="d-flex flex-column">
                    <svg width="140" height="140" viewBox="0 0 140 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_360_178)">
                        <rect x="30" y="20" width="80" height="80" rx="10" fill="#0384FE"/>
                        </g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M71.0233 44.9975C71.0218 44.1691 70.349 43.4987 69.5206 43.5002C68.6922 43.5016 68.0218 44.1744 68.0233 45.0028L68.0472 58.5178L54.5322 58.4939C53.7038 58.4924 53.031 59.1628 53.0295 59.9912C53.0281 60.8197 53.6984 61.4924 54.5269 61.4939L68.0525 61.5179L68.0765 75.0435C68.078 75.872 68.7507 76.5423 69.5792 76.5409C70.4076 76.5394 71.078 75.8666 71.0765 75.0382L71.0525 61.5232L84.5676 61.5471C85.396 61.5486 86.0688 60.8782 86.0702 60.0498C86.0717 59.2214 85.4013 58.5486 84.5729 58.5471L71.0472 58.5232L71.0233 44.9975Z" fill="white"/>
                        <defs>
                        <filter id="filter0_d_360_178" x="0" y="0" width="140" height="140" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset dy="10"/>
                        <feGaussianBlur stdDeviation="15"/>
                        <feComposite in2="hardAlpha" operator="out"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.3 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_360_178"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_360_178" result="shape"/>
                        </filter>
                        </defs>
                     </svg>    
                     <span>Add New Course</span>                    
                 </a>
            </div>
        </div>
     </div>
      <!-- Add chapter in program start -->
    </div>
    
</div>
@endsection
@section('page-script')
<script>
    $(document).ready(function() {
    });
 </script>   
@endsection  