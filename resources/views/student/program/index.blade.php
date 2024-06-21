@extends('layouts.app')

@section('page-style')
<style>
.description{
    color:black;
}
.title{
    color:black;
}
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
    <div class="programs-section">
        <div class="row">
            @foreach($programs as $program)
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
    <!-- programs section start -->

</div>

<!-- exampleModal start -->
 <div class="modal fade" id="CourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header border-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
   $(document).ready(function() {
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
                var courseHtml = `
                    <div class="image">
                        <a href="javascript:void(0)" data-id="${course.id}"><img data-lazy="{{ asset('storage/') }}/${course.image}" data-type="{{ asset('storage/') }}/${course.image}" data-url="{{ asset('storage/') }}/${course.image}" />
                    </div>`;
                sliderDiv.append(courseHtml);
            });

            // Destroy the previous Slick instance if it exists
            if (sliderDiv.hasClass('slick-initialized')) {
                sliderDiv.slick('unslick');
            }

            // Initialize Slick Slider
            sliderDiv.slick({
                lazyLoad: 'ondemand',
                slidesToShow: 2,
                slidesToScroll: 1,
                prevArrow: '<button class="slide-arrow prev-arrow"></button>',
                nextArrow: '<button class="slide-arrow next-arrow"></button>',
                autoplay: true,
                autoplaySpeed: 3000, 
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
        });

        // Reinitialize the slider each time the modal is shown
        $('#CourseModal').on('shown.bs.modal', function () {
            $('.slider').slick('setPosition');
        });

        // Handle click event on course images
        $(document).on('click', '.image a', function() {
            var phaseId = $(this).data('id');
            var phaseUrl = `/phases/${phaseId}`; // Change this to your actual phase URL pattern
            window.location.href = phaseUrl;
        });

    });
</script>
@endsection