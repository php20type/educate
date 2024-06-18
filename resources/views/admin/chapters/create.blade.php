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
        <form action="{{ route('chapters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group position-relative mb-4">
                        <div class="image-box"> 
                            <div class="image-box"> 
                                <img src="{{ asset('img/home/program-image3.png') }}" alt="" id="image-preview"/>
                            </div>
                            <div class="edit-btn add-new">
                                <input type="file" id="image" name="image" class="d-none" onchange="previewImage(event)">
                                <a href="javascript:void(0)" class="btn change" onclick="document.getElementById('image').click()">
                                    <i class="fa-regular fa-plus me-1"></i> Add Image
                                </a>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="col-lg-12 col-md-12"> 
                    <div class="form-group mb-4">
                        <label class="form-label">Video File</label>
                        <input type="file" name="video_link" class="form-control" />
                        @error('video_link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6"> 
                    <div class="form-group mb-4">
                        <label class="form-label">Course Name</label>
                        <select class="form-control" id="course_id" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }} {{ (isset($selectedCourse) && $selectedCourse->id == $course->id) ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6"> 
                    <div class="form-group mb-4">
                        <label class="form-label">Chapter Name</label>
                        <input type="text" placeholder="Type here..." name="title" class="form-control" />
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6"> 
                    <div class="form-group mb-4">
                        <label class="form-label">PDF</label>
                        <input type="file" placeholder="Type here..." name="pdf_url" class="form-control" />
                        @error('pdf_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6"> 
                    <div class="form-group mb-4">
                        <label class="form-label">Affiliate link</label>
                        <input type="text" placeholder="Type here..." name="affiliate_link" class="form-control" />
                        @error('affiliate_link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12 col-md-12"> 
                    <div class="form-group mb-4">
                        <label class="form-label">Description</label>
                        <textarea rows="6" class="form-control" name="description"  placeholder="Type here..."></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12 col-md-12"> 
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Save & Continue</button>
                    </div>
                </div>
            </div>    
        </form>
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