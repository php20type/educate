
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
    <!-- edit chapter start -->
    <div class="program-edit">
        <form class="mb-5" id="" action="{{ route('chapters.update', $chapter->id) }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group position-relative mb-4">
                        <div class="image-box"> 
                            <img id="image-preview" src="{{ $chapter->image ? asset('storage/' . $chapter->image) : asset('img/home/program-image2.png') }}" alt="" />
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
                <div class="col-lg-12 col-md-12">
                    <div class="form-group mb-4">
                        <label class="form-label">Video File</label>
                        @if($chapter->video_link)
                            <div>
                                <video width="320" height="240" controls>
                                    <source src="{{ asset('storage/' . $chapter->video_link) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
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
                                <option value="{{ $course->id }}" 
                                    {{ old('course_id', $chapter->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
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
                        <input type="text" name="title" value="{{ old('title', $chapter->title) }}" class="form-control" />
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
                        @if($chapter->pdf_url)
                            <div>
                                <a href="{{ asset('storage/' . $chapter->pdf_url) }}" target="_blank">Download PDF</a>
                            </div>
                        @endif
                        <input type="file" name="pdf_url" class="form-control" />
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
                        <input type="text" name="affiliate_link" value="{{ old('affiliate_link', $chapter->affiliate_link) }}" class="form-control" />
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
                        <textarea rows="6" class="form-control" name="description">{{ old('description', $chapter->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Save & Continue</button>
                   </div>
                </div>
            </div>
     </form>
    
    </div>
    <!-- edit chapter end -->

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