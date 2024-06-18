@extends('layouts.app')

@section('page-style')
<style>
    .edit-btn.add-new label {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .edit-btn.add-new input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
</style>
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

    <!-- edit program start -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="program-edit">
        <form class="mb-5" id="program-form" action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            <div class="image-box"> 
                <img src="{{ asset('img/home/program-image3.png') }}" alt="" id="preview-image" />
            </div>
            <div class="edit-btn add-new">
                <label class="btn change">
                    <i class="fa-regular fa-plus me-1"></i> Add Image
                    <input type="file" name="image" class="d-none" onchange="previewImage(event)" />
                </label>
            </div>
            <div class="form-group mb-4">
                <label class="form-label">Program Name</label>
                <input name="name" type="text" placeholder="Type here..." class="form-control" required />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label class="form-label">Description</label>
                <textarea rows="6" name="description" class="form-control" placeholder="Type here..." required></textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Save & Continue</button>
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
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection