
@extends('layouts.app')

@section('page-style')

@endsection

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
            <div class="profile-dropdown">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="#" data-bs-toggle="dropdown" class="dropdown">
                            <p><i class="fa-solid fa-user me-1"></i> {{ auth()->user()->first_name }}</p>
                        </a>
                        <ul class="dropdown-menu border-light-subtle py-3">
                            <li class="mb-3"><a class="dropdown-item border-bottom-1" href="{{ route('user.edit',auth()->user()->id) }}"><svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0001 20C8.48816 20.0043 6.99532 19.6622 5.6361 19C5.13865 18.758 4.66203 18.4754 4.2111 18.155L4.0741 18.055C2.83392 17.1396 1.81997 15.9522 1.1101 14.584C0.375836 13.1679 -0.00499271 11.5952 4.94229e-05 10C4.94229e-05 4.47715 4.47725 0 10.0001 0C15.5229 0 20.0001 4.47715 20.0001 10C20.0051 11.5944 19.6247 13.1664 18.8911 14.582C18.1822 15.9494 17.1697 17.1364 15.9311 18.052C15.4639 18.394 14.968 18.6951 14.4491 18.952L14.3691 18.992C13.009 19.6577 11.5144 20.0026 10.0001 20ZM10.0001 15C8.50158 14.9971 7.12776 15.834 6.4431 17.167C8.68449 18.2772 11.3157 18.2772 13.5571 17.167V17.162C12.8716 15.8305 11.4977 14.9954 10.0001 15ZM10.0001 13C12.1662 13.0028 14.1635 14.1701 15.2291 16.056L15.2441 16.043L15.2581 16.031L15.2411 16.046L15.2311 16.054C17.7601 13.8691 18.6644 10.3423 17.4987 7.21011C16.3331 4.07788 13.3432 2.00032 10.0011 2.00032C6.65901 2.00032 3.66909 4.07788 2.50345 7.21011C1.33781 10.3423 2.2421 13.8691 4.7711 16.054C5.83736 14.169 7.83446 13.0026 10.0001 13ZM10.0001 12C7.79096 12 6.0001 10.2091 6.0001 8C6.0001 5.79086 7.79096 4 10.0001 4C12.2092 4 14.0001 5.79086 14.0001 8C14.0001 9.06087 13.5787 10.0783 12.8285 10.8284C12.0784 11.5786 11.061 12 10.0001 12ZM10.0001 6C8.89553 6 8.0001 6.89543 8.0001 8C8.0001 9.10457 8.89553 10 10.0001 10C11.1047 10 12.0001 9.10457 12.0001 8C12.0001 6.89543 11.1047 6 10.0001 6Z" fill="#4DA6FF"/>
                                </svg>                        
                                Profile </a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <svg class="me-2" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 18H7C5.89543 18 5 17.1046 5 16V12H7V16H16V2H7V6H5V2C5 0.89543 5.89543 0 7 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM9 13V10H0V8H9V5L14 9L9 13Z" fill="#4DA6FF"/>
                                        </svg>                            
                                        Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <p><i class="fa-solid fa-gear me-1"></i> </p>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <p><i class="fa-solid fa-bell me-1"></i> </p>
                        </a>
                    </li>
                   
                </ul>
               
            </div>
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
        <form class="mb-5" id="" action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group position-relative mb-4">
                        <div class="image-box"> 
                            <img id="image-preview" src="{{ $course->image ? asset('storage/' . $course->image) : asset('img/home/program-image2.png') }}" alt="" />
                        </div>
                        <div class="edit-btn">
                            <a href="#" class="btn remove">Remove Image</a>
                            <label class="btn change">
                                Change Image
                                <input type="file" name="image" style="display: none;" onchange="previewImage(event)">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-4">
                        <label class="form-label">Course Title</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" class="form-control" />
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group mb-4">
                        <label class="form-label">Program Name</label>
                        <select class="form-control" id="program_id" name="program_id">
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" 
                                    {{ old('program_id', $course->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-4">
                        <label class="form-label">Description</label>
                        <textarea rows="6" class="form-control" name="description">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group mb-4">
                        <button type="submit" class="btn btn-outline-primary">Save & Continue</button>
                   </div>
                </div>
            </div>
     </form>
     <div class="image-list">
        @foreach ($chapters as $cpt)
            <div class="image-box">
                <a href="{{ route('chapters.edit', $cpt->id) }}" class="d-flex flex-column">
                <img src="{{ isset($cpt->image) ? asset('storage/'.$cpt->image) : asset('img/home/rec1254.png') }}" alt="" />
                <p><b>{{ $cpt->title }}</b></p>
                </a>  
            </div>  
        @endforeach
        <div class="image-box">
            <div class="border-dash">
                 <a href="{{ route('chapters.create', $course->id) }}" class="d-flex flex-column">
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
                     <span>Add New Chapter</span>                      
                 </a>
            </div>
        </div>
     </div>
    </div>
    <!-- edit program end -->
</div>
@endsection
@section('page-script')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection