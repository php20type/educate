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
    <div class="programs-videos">
        <div class="back">
            <a href="#" class="text-white"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="program-details">
                    <div class="program-image">
                        <iframe id="videoFrame" src="" frameborder="0" style="width: 100%; height: 500px;"></iframe>
                    </div>
                    <div class="details-content">
                         
                        <div class="completed-badge py-3 d-flex justify-content-between">
                            <h4 id="phaseTitle">{{ $phase->title }}</h4>
                            <a href="#" class="btn btn-outline-primary px-3 py-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="20" height="20" rx="10" fill="#0384FE"/>
                                    <path d="M7.84663 14L4 10.2079L4.96166 9.25988L7.84663 12.104L14.0383 6L15 6.94803L7.84663 14Z" fill="white"/>
                                </svg>
                                Completed
                            </a>
                        </div>
                       
                        <p id="phaseDescription">{{ $phase->description }}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sales-ecosystem">

                    <h4 class="sec-title">All Phases</h4>
                    <select id="phaseDropdown" onchange="loadPhase(this.value)">
                        <option value="">Select a Phase</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ $phase->id == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                    
                    <h4 class="sec-title">Chapters</h4>
                     
                    <div id="chaptersList">
                        @foreach ($chapters as $chapter)
                            @php
                                $progress = $chapter->progress->where('student_id', auth()->id())->first();
                                $isCompleted = $progress ? $progress->completed : false;
                            @endphp

                            @if ($loop->first || $isCompleted)
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="sales-image position-relative">
                                            <a href="#" onclick="loadVideo('{{ '/storage/' . $chapter->video_link }}')">
                                                <img src="{{ asset('/storage/' . $chapter->image) }}" alt="{{ $chapter->title }}" />
                                                <div class="check-svg">
                                                    <img src="{{ asset('img/home/check.svg') }}" alt="" />
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="sales-content">
                                            <h5>{{ $chapter->title }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="sales-image position-relative">
                                            <a href="#" class="disabled">
                                                <img src="{{ asset('/storage/' . $chapter->image) }}" alt="{{ $chapter->title }}" />
                                                <div class="check-svg">
                                                    <img src="{{ asset('img/home/lock.svg') }}" alt="" />
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="sales-content">
                                            <h5>{{ $chapter->title }}</h5>
                                            <p>This chapter is locked. Complete previous chapters to unlock.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <!-- programs section end -->
</div>

@endsection
@section('page-script')
<script>
    function loadVideo(videoLink, chapterId) {
        document.getElementById('videoFrame').src = videoLink;

        document.getElementById('videoFrame').onended = function() {
            markChapterCompleted(chapterId);
        };
    }

    function markChapterCompleted(chapterId) {
        fetch(`/chapters/${chapterId}/complete`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNextChapter(chapterId);
            }
        });
    }

    function loadNextChapter(currentChapterId) {
        const courseId = document.getElementById('phaseDropdown').value;
        fetch(`/courses/${courseId}/chapters/${currentChapterId}/next`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    loadVideo(`/storage/${data.video_link}`, data.id);
                } else {
                    alert('All chapters completed!');
                    // Optionally mark the course as completed
                }
            });
    }
</script>
@endsection
