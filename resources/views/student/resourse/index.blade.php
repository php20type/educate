@extends('layouts.app')

@section('page-style')
<style>
/* .description{
    color:black;
}
.title{
    color:black;
} */
.slide-arrow{
			position: absolute;
			top: 50%;
			margin-top: -15px;
		}
		.prev-arrow{
			left: -30px;
			width: 0;
			height: 0;
			border-left: 0 solid transparent;
			border-right: 15px solid #113463;
			border-top: 10px solid transparent;
			border-bottom: 10px solid transparent;
			background: none;
		}
		.next-arrow{
			right: -30px;
			width: 0;
			height: 0;
			border-right: 0 solid transparent;
			border-left: 15px solid #113463;
			border-top: 10px solid transparent;
			border-bottom: 10px solid transparent;
			background: none;
		}
		/** Dev. Slider CSS **/
		.slick-slide img {
			display: block;
			height: auto;
			width: 100%;
		}  
		.fixed-size-image {
            width: 100%;
            height: 200px; /* Adjust this value as needed */
            object-fit: cover; /* Ensures the image covers the area, cropping if necessary */
            object-position: center; /* Center the image within the container */
        }
        .pdf-box {
            padding: 20px;
            border: 3px solid gray;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
        }
        .pdf-box .pdf-view h4 {
            color: #bababa;
        }
        .pdf-box .pdf-view p {
            color: #6c6c6c;
        }
        .pdf-box .pdf-btn a {
            color: #6c6c6c;
            font-size: 32px;
        }
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
                <form class="search-bar position-relative me-2" id="search-form" method="GET" action="{{ route('student.search') }}">
                    <input type="text" name="query" id="query" placeholder="Search by program, module or document name..." class="form-control">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </form>
                @include('student.header')
            </div>
        </div>
    </div>
    <!-- header end -->

    <!-- resources programs start -->
    <div class="programs-section">
        <div class="resources-list py-4">
        <h4 class="sec-title pb-3">Programs</h4>
            <div class="row" id="program-list">
                @foreach ($programs as $program)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="program-box">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#CourseModal" 
                            data-image="{{ asset('storage/'.$program->image) }}" 
                            data-title="{{ $program->name }}" 
                            data-description="{{ $program->description }}"
                            data-courses="{{ json_encode($program->courses) }}">
                                <img src="{{ asset('storage/'.$program->image) }}" alt="" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- resources programs end -->

    <!-- search results start -->
    <div class="resources-programs" id="search-results" style="display: none;">
        <h4 class="sec-title pb-3">Search Results</h4>
        <div class="resources-list py-4">
            <!-- Programs section -->
            <div class="pt-0">
                <h5 class="mb-3">Programs</h5>
                <div class="row" id="search-result-programs">
                    <!-- Program search results will be inserted here -->
                </div>
            </div>
            
            <!-- Chapters section -->
            <div class="pt-5">
                <h5 class="mb-3">Chapters</h5>
                <div class="row" id="search-result-chapters">
                    <!-- Chapter search results will be inserted here -->
                </div>
            </div>
            
            <!-- PDFs section -->
            <div class="pt-5">
                <h5 class="mb-3">PDFs</h5>
                <div class="row" id="search-result-pdfs">
                    <!-- PDF search results will be inserted here -->
                </div>
            </div>
        </div>
    </div>
    <!-- search results end -->

</div>

<!-- exampleModal start -->
 <div class="modal fade" id="CourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header border-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <div class="course-sec">
                 <img class="mb-4" src="" alt="" />
                 <p class="title"></p>
                 <p class="description"></p>
            </div>
            <div class="phases-sec">
                <p>Phases:</p>  
                <div class="phases-image">
                    <div class="slider lazy">
                        <!-- Courses will be dynamically added here -->
                    </div>
                    <div class="news__arrows"><div class="news__dots"></div></div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<!-- exampleModal end -->
@endsection

@section('page-script')
<script>
    $('#CourseModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var image = button.data('image'); // Extract info from data-* attributes
        var title = button.data('title');
        var description = button.data('description');
        var courses = button.data('courses');
        
        // Update the modal's content.
        var modal = $(this);
        modal.find('.modal-body .course-sec img').attr('src', image);
        modal.find('.modal-body .course-sec .title').text(title);
        modal.find('.modal-body .course-sec .description').text(description);

        // Clear existing chapters
        var sliderDiv = modal.find('.modal-body .slider');
        sliderDiv.empty();

        // Add new courses
        courses.forEach(function(course) {
            var imageUrl = course.image ? `{{ asset('storage/') }}/${course.image}` : `{{ asset('img/home/rec1254.png') }}`;
            var courseHtml = `
                <div class="image">
                    <a href="javascript:void(0)" data-id="${course.id}">
                        <img src="${imageUrl}" class="fixed-size-image" alt="Course Image"/>
                    </a>
                </div>`;
            sliderDiv.append(courseHtml);
        });

        // Destroy the previous Slick instance if it exists
        if (sliderDiv.hasClass('slick-initialized')) {
            sliderDiv.slick('unslick');
        }

        // Initialize Slick Slider
        // let slider = $('.news__slider');
        sliderDiv.slick({
            lazyLoad: 'ondemand',
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 3000, 
            appendArrows: $('.news__arrows'),
            prevArrow: '<div class="news__arrow news__arrow_dir_left"></div>',
            nextArrow: '<div class="news__arrow news__arrow_dir_right"></div>',
		    dots: true,
		    appendDots: $('.news__dots'),
		    customPaging : function(slider, i) {
                var thumb = $(slider.$slides[i]).data();
                return '0' + (i + 1);
            },
		 dotsClass: 'news__dots-list',
    });
});


        // Clear existing courses
        // var phasesImageDiv = modal.find('.modal-body .phases-image .row');
        // phasesImageDiv.empty();

        // Add new courses
        // courses.forEach(function(course) {
        //     var courseHtml = `
        //         <div class="col-md-3 col-6">
        //             <a href="#"><img src="{{ asset('storage/') }}/${course.image}" /></a>
        //         </div>`;
        //     phasesImageDiv.append(courseHtml);
        // });
    // });

    // Reinitialize the slider each time the modal is shown
    $('#CourseModal').on('shown.bs.modal', function () {
        $('.slider').slick('setPosition');
    });
    
    $(document).ready(function() {
        $(document).keypress(function(event) {
            if (event.which === 47 || event.keyCode === 47) {
                event.preventDefault();
                $('#query').focus();
            }
        });
    });


    // Handle click event on course images
    $(document).on('click', '.image a', function() {
        var phaseId = $(this).data('id');
        var phaseUrl = `/phases/${phaseId}`; // Change this to your actual phase URL pattern
        window.location.href = phaseUrl;
    });

    document.getElementById('search-form').addEventListener('keyup', function(e) {
        e.preventDefault();
        var query = document.getElementById('query').value;

        fetch(`/student/search?query=${query}`)
            .then(response => response.json())
            .then(data => {
                var programList = document.getElementById('program-list');
                var searchResults = document.getElementById('search-results');
                var searchResultPrograms = document.getElementById('search-result-programs');
                var searchResultChapters = document.getElementById('search-result-chapters');
                var searchResultPdfs = document.getElementById('search-result-pdfs');

                programList.style.display = 'none';
                searchResults.style.display = 'block';

                searchResultPrograms.innerHTML = '';
                searchResultChapters.innerHTML = '';
                searchResultPdfs.innerHTML = '';

                if (data.programs.length > 0) {
                    data.programs.forEach(function(program) {
                        searchResultPrograms.innerHTML += `
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="resources-image">
                                    <a href="javascript:void(0)" data-id="${program.id}" data-bs-toggle="modal" 
                                        data-bs-target="#CourseModal" 
                                        data-image="${program.image}" 
                                        data-title="${program.name}" 
                                        data-description="${program.description}">
                                    <img src="${program.image ? '/storage/' + program.image : '/img/home/rec1254.png'}" alt="${program.title}" style="width: 100%; height: auto;"/>
                                </div>
                            </div>`;
                    });
                }

                if (data.chapters.length > 0) {
                    data.chapters.forEach(function(chapter) {
                        searchResultChapters.innerHTML += `
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="resources-image">
                                    <img src="${chapter.image ? '/storage/' + chapter.image : '/img/home/rec1254.png'}" alt="${chapter.title}" style="width: 100%; height: auto;"/>
                                </div>
                            </div>`;
                    });
                }

                if (data.pdfs.length > 0) {
                    data.pdfs.forEach(function(pdf) {
                        console.log(pdf);
                        searchResultPdfs.innerHTML += `
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="resources-image">
                                    <div class='pdf-box'>
                                        <div class='pdf-view'>
                                            <a href="/storage/${pdf.pdf_url}" target="_blank">
                                                <h4>${pdf.title}</h5>
                                                <p>${pdf.affiliate_link}</p>
                                            </a>
                                        </div>
                                        <div class='pdf-btn'>
                                            <a href="/storage/${pdf.pdf_url}" download>
                                                <i class="fa-duotone fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                }
            });
    });
</script>
@endsection
