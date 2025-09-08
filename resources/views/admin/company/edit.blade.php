@extends('admin.includes.layout')

@section('title', 'Company Details')

@section('content')

    <!-- company details start -->
    <div class="company-details-section">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="main-content">
                        <!-- Map Section -->
                        <div class="map-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56430970.783862405!2d-173.4960524!3d30.314748300000012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8647393108e90293%3A0x2541772067591635!2sValero!5e0!3m2!1sen!2sin!4v1750656614795!5m2!1sen!2sin"
                                width="100%" height="240" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <!-- Lead Header -->
                        <div class="lead-header">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <img src="{{ asset('img/home/image25.png') }}" alt="Company" class="company-logo me-3">
                                    <div>
                                        <h4 class="mb-1">{{ $company->name }}</h4>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="text-warning me-2">MATRIX ID:</span>
                                            <span>1976</span>
                                        </div>
                                        <div class="star-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star star-empty"></i>
                                            <i class="fas fa-star star-empty"></i>
                                        </div>
                                    </div>
                                </div>
                                <button class="delete-btn">
                                    <i class="fas fa-trash me-2"></i>DELETE
                                </button>
                            </div>
                            <div class="mt-3">
                                {{-- <small class="text-muted">Created by <span class="text-warning">
                                    </span> 3 years ago</small> --}}
                                <small class="text-muted">Created by <span
                                        class="text-warning">{{ $company->user->name }}</span>
                                    {{ $company->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="mt-3">
                                <span class="badge-customer">
                                    {{ $company->tag?->name ?? 'N/A' }}
                                </span>
                            </div>

                            <div class="mt-4">
                                <select class="form-select d-inline-block w-100" aria-label="Default select example">
                                    <option value="">Add tags...</option>
                                    @foreach ($companytags as $companytag   )
                                        <option value="{{ $companytag->id }}">{{ $companytag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- People Section -->
                        <div class="section-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>PEOPLE</h5>
                                <a href="javascript:void(0);" class="text-warning" id="toggleAddPeople">Add A Person</a>
                            </div>

                            <!-- Slide Toggle Form -->
                            <div id="addPeopleForm" class="mb-3" style="display: none;">
                                <form id="addPeopleAjaxForm" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <input type="hidden" name="company_id" value="{{ $company->id }}">
                                                <input type="text" class="form-control" placeholder="Contact Name"
                                                    name="contact_name"required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <input type="text" class="form-control" placeholder="Job Title"
                                                    name="job_title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <input type="tel" class="form-control" name="phone"
                                                    placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <input type="email" class="form-control" placeholder="Email"
                                                    name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <textarea rows="3" placeholder="Description" class="form-control" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-warning btn-sm">Add
                                                Person</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Example Existing people -->
                            @foreach ($peoples as $people)
                                <div class="people-card">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('img/home/profile.png') }}" alt="Paul Blake"
                                            class="person-avatar me-3">
                                        <div>
                                            <h6 class="mb-0">{{ $people->contact_name }}</h6>
                                            <small class="text-warning">{{ $people->job_title }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="text-end">
                                            <div>{{ $people->phone }}</div>
                                            <div class="text-muted">{{ $people->email }}</div>
                                        </div>
                                        <button class="btn btn-sm btn-outline-secondary"
                                            onclick="deletePerson({{ $people->id }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Tasks Section -->
                        <div class="section-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>TASKS</h5>
                                <a class="text-warning" href="javascript:void(0);" id="toggleAddTask">Add A Task</a>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="task-icon me-3">
                                    <i class="fas fa-list"></i>
                                </div>
                                <div class="flex-1">
                                    <h6>NO UPCOMING TASKS</h6>
                                    <p class="text-muted mb-0">Nice work! Now, add tasks to your leads like
                                        "Mail a proposal" or "Send follow-up email" to be reminded here.</p>
                                </div>
                            </div>
                        </div>

                        {{-- <div id="addTaskForm" class="my-3" style="display: none;">

                            <form id="addTaskAjaxForm" action="{{ route('admin.tasks.store') }}" post="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <input type="hidden" name="company_id" value="{{ $company->id }}">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Add a Task">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <input type="datetime-local" name="due_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <select class="form-select" name="user_id" required>
                                                <option value="">-- Select User --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <textarea rows="3" placeholder="" name="description" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning btn-sm">Add
                                            Task</button>
                                    </div>
                                </div>
                            </form>

                        </div> --}}
                        {{-- Task form --}}
                        <div id="addTaskForm" class="my-3" style="display: none;">

                            <form id="addTaskAjaxForm" action="{{ route('admin.tasks.store') }}" post="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Add a Task" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-2">
                                            <input type="datetime-local" name="due_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <select class="form-select" name="user_id" required>
                                                <option value="">-- Select User --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <textarea rows="3" placeholder="Include any description you need to help complete this task…"
                                                name="description" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-warning btn-sm">Add
                                            Task</button>
                                    </div>
                                </div>
                            </form>

                        </div>


                        <!-- Activities Section -->
                        <div class="section-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>ACTIVITIES</h5>
                                <a href="javascript:void(0)" onclick="scheduleActivity()" class="text-warning">Schedule
                                    an activity</a>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="activity-icon me-3">
                                    <i class="fas fa-list"></i>
                                </div>
                                <div class="flex-1">
                                    <h6>NO UPCOMING ACTIVITIES</h6>
                                    <p class="text-muted mb-0">Schedule a meeting or phone call to remind
                                        yourself and your colleagues. Once the activity occurs, log it to see it
                                        in the timeline.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Notes Section -->
                        <div class="section-card">
                            <!-- Header Tabs -->
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="activity-tab" data-bs-toggle="tab"
                                        data-bs-target="#write-activity-content" type="button" role="tab"
                                        aria-controls="write-activity-content" aria-selected="true">
                                        LOG AN ACTIVITY
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="note-tab" data-bs-toggle="tab"
                                        data-bs-target="#write-note-content" type="button" role="tab"
                                        aria-controls="write-note-content" aria-selected="false">
                                        <i class="fas fa-edit me-2"></i>WRITE A NOTE
                                    </button>
                                </li>
                                <li class="nav-item ms-auto">
                                    <button class="btn btn-outline-secondary btn-sm me-2">
                                        <i class="fas fa-arrow-up me-1"></i>SEND A TEXT
                                    </button>
                                    <button class="btn btn-dark btn-sm">
                                        <i class="fas fa-envelope me-1"></i>SEND AN EMAIL
                                    </button>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <!-- Activity Tab -->
                                <div class="tab-pane fade show active activity-form" id="write-activity-content"
                                    role="tabpanel" aria-labelledby="activity-tab">

                                    <form action="{{ route('admin.login.activity') }}" method="post"
                                        id="loginActivity">
                                        @csrf
                                        <textarea class="form-textarea w-100" name="title" placeholder="Type Here..."></textarea>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">ACTIVITY</label>
                                                <select class="form-select-custom" name="activity_type">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($activity_types as $activity_type)
                                                        <option value="{{ $activity_type->id }}">
                                                            {{ $activity_type->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">DURATION</label>
                                                <input type="hidden" name="start_time" id="start_time">
                                                <input type="hidden" name="end_time" id="end_time">
                                                {{-- <input type="hidden" name="participant_id" value={{ $peoples->id }}> --}}

                                                <select class="form-select-custom" name="duration" id="duration">
                                                    <option value="">-- Select --</option>
                                                    <option value="15">15 Min</option>
                                                    <option value="30">30 Min</option>
                                                    <option value="60">1 Hour</option>
                                                    <option value="120">2 Hours</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn-login">LOGIN ACTIVITY</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Note Tab -->
                                <div class="tab-pane fade activity-form" id="write-note-content" role="tabpanel"
                                    aria-labelledby="note-tab">
                                    <textarea class="form-textarea w-100" placeholder="Write your note here..." rows="6"></textarea>
                                    <div class="form-row">
                                        <button class="btn-login">SAVE NOTE</button>
                                    </div>
                                </div>
                            </div>


                            <!-- Filter Section -->
                            <div class="filter-section">
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <select class="form-select dropdown-orange">
                                            <option selected>All Entries</option>
                                            <option value="1">Last 7 Days</option>
                                            <option value="2">Last 30 Days</option>
                                            <option value="3">Last 90 Days</option>
                                        </select>

                                    </div>
                                    <div class="col-auto">
                                        <select name="activity_id" class="form-select dropdown-orange">
                                            <option value="">-- Select Activity --</option>
                                            @foreach ($activity_types as $activity_type)
                                                <option value="{{ $activity_type->id }}">{{ $activity_type->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select dropdown-orange">
                                            <option selected>All Users & Team</option>
                                            <option value="1">User 1</option>
                                            <option value="2">User 2</option>
                                            <option value="3">Team A</option>
                                        </select>

                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select dropdown-orange">
                                            <option selected>All Time</option>
                                            <option value="1">Open</option>
                                            <option value="2">Closed</option>
                                            <option value="3">Pending</option>
                                        </select>

                                    </div>
                                    <div class="col-auto ms-auto">
                                        <button class="btn btn-warning">
                                            <i class="fa-regular fa-gear"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- AI Summary -->
                            <div class="ai-summary">
                                <h5 class="fw-bold mb-3">AI SUMMARY</h5>

                                <div class="mb-3">
                                    <strong>Introduction:</strong><br>
                                    <span class="text-muted">The 12th Street Church of Christ in Shallowater has
                                        been interacting with Nutshell users, primarily Mark Corkery and Christy
                                        Haynes, regarding their interest in GermBlast's disinfection
                                        services.</span>
                                </div>

                                <div class="mb-3">
                                    <strong>Action Items:</strong><br>
                                    <ul class="text-muted mb-0">
                                        <li>Follow up with Paul Blake, the Chairman of Deacons, to discuss the
                                            possibility of a renewed quarterly service contract.</li>
                                        <li>Provide a quote for a one-time disinfection service before May 24th.
                                        </li>
                                        <li>Obtain floor plans from the church to help with the service
                                            proposal.</li>
                                        <li>Reach out to Paul Blake when the Church has plans to build a new
                                            facility on land they have purchased south of town.</li>
                                    </ul>
                                </div>

                                <div class="mb-3">
                                    <strong>Activity Summary:</strong><br>
                                    <span class="text-muted">GermBlast has provided a one-time disinfection
                                        service for the 12th Street Church of Christ in November 2021, which was
                                        well-received. The church has since decided to use GermBlast on an
                                        as-needed basis rather than committing to a quarterly service contract.
                                        GermBlast has remained in contact with the church, providing proposals
                                        and following up on their needs.</span>
                                </div>

                                <div class="mb-3">
                                    <strong>Decision:</strong><br>
                                    <span class="text-muted">The 12th Street Church of Christ has been a client
                                        of GermBlast since at least 2020. They have been pleased with the
                                        service provided and have kept GermBlast in mind for future needs. The
                                        church is led by Paul Blake, the Chairman of Deacons, who has been the
                                        primary point of contact. The church has recently purchased land south
                                        of town and is planning to build a new facility, which could present an
                                        opportunity for GermBlast to provide services in the future.</span>
                                </div>

                                <div class="mb-3">
                                    <strong>Conversation Starters:</strong><br>
                                    <ul class="text-muted mb-0">
                                        <li>Ask Paul Blake about the church's plans for the new facility and if
                                            they anticipate any disinfection or cleaning needs during the
                                            construction or transition process.</li>
                                        <li>Inquire about any upcoming events or activities at the current
                                            church location that may require GermBlast's services.</li>
                                        <li>Offer to provide a tour of GermBlast's facilities or introduce the
                                            team that would be servicing the church, to further build the
                                            relationship.</li>
                                    </ul>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-thumbs-up text-success me-2"></i>
                                        <i class="fas fa-thumbs-down text-danger"></i>
                                    </div>
                                    <small class="text-muted">Generated 10 minutes ago</small>
                                </div>
                            </div>

                            <!-- Timeline -->
                            <div class="timeline position-relative">
                                <!-- Timeline Item 1 -->
                                <div class="timeline-item">
                                    <div class="timeline-icon calendar">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">4:50 AM on Apr 22, 2023</div>
                                        <div class="text-muted">
                                            <strong>Rodney Madsen</strong> reassigned <strong>12th Street Church
                                                of Christ</strong> to <strong class="text-warning">Denise
                                                Bradley</strong> from <strong class="text-warning">Christy
                                                Haynes</strong>.
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item 2 -->
                                <div class="timeline-item">
                                    <div class="timeline-icon email">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">9:38 PM on Feb 8, 2022</div>
                                        <div class="text-muted mb-2">
                                            <strong class="text-warning">Heath Herrington</strong> emailed
                                            <strong>Paul Blake</strong>
                                        </div>

                                        <div class="email-preview">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="badge bg-warning text-dark">Outbound Email</span>
                                                <div>
                                                    <span class="badge bg-secondary me-1">7</span>
                                                    <span class="badge bg-secondary">85</span>
                                                </div>
                                            </div>
                                            <div class="fw-bold mb-2">GermBlast Discussion Follow-Up</div>
                                            <div class="text-muted">
                                                Mr. Blake, It was a pleasure meeting you over the phone today,
                                                sir! Thank you so much for your kind words & consideration of
                                                GermBlast at 12th Street Church of Christ...
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Item 3 -->
                                <div class="timeline-item">
                                    <div class="timeline-icon phone">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">9:30 PM on Feb 8, 2022</div>
                                        <div class="text-muted mb-2">
                                            <strong class="text-warning">Cindy Gotham</strong> logged an
                                            activity with
                                            <strong class="text-warning">12th Street Church of Christ</strong>,
                                            <strong>Paul Blake</strong>,
                                            <strong class="text-warning">Heath Herrington</strong>,
                                            <strong class="text-warning">12th Street Church of Christ -
                                                2022</strong>
                                        </div>

                                        <div class="email-preview">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="fw-bold">Phone Call</span>
                                                <div>
                                                    <span class="badge bg-secondary me-1">7</span>
                                                    <span class="badge bg-secondary me-1">6</span>
                                                    <span class="badge bg-secondary">15</span>
                                                </div>
                                            </div>
                                            <div class="text-muted">
                                                Heath spoke with Paul Blake who is the Chairman of Deacons at
                                                12th St Church of Christ. We did a single service response for
                                                them in November. But we hadn't done quarterly services for them
                                                in the 9 months leading up to that. So Heath talked with Mr
                                                Blake about the possibility of doing a renewal with them for
                                                quarterly services and a partnership...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>LEADS</h6>
                                <a href="javascript:void(0)" onclick="addLead()" class="text-warning">Create a lead</a>
                            </div>
                            <div class="lead-carder">
                                <div class="row text-center">
                                    <div class="col-3">
                                        <div class="metric-value">$4.32k</div>
                                    </div>
                                    <div class="col-3">
                                        <div class="metric-value won">2 won</div>
                                    </div>
                                    <div class="col-3">
                                        <div class="metric-value">$4</div>
                                    </div>
                                    <div class="col-3">
                                        <div class="metric-value lost">1 lost</div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="sidebar-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>KEEP IN TOUCH</h6>
                                <a href="#" class="text-warning">Remind me to follow up</a>
                            </div>
                            <p class="small text-muted">Last Contacted 3 Years Ago<br>
                                You've Never Contacted This Company</p>
                        </div>
                        {{-- Company section form --}}
                        <form class="sidebar-section">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6>COMPANY DETAILS</h6>
                                <button class="btn btn-outline-secondary btn-sm">Edit</button>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><b>COMPANY Type</b></label>
                                <select class="form-select">
                                    <option value="">Select company type</option>
                                    @foreach ($company_types as $company_type)
                                        <option value="{{ $company_type->id }}"
                                             {{ $company->company_type_id == $company_type->id ? 'selected' : '' }}>
                                            {{ $company_type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><b>INDUSTRY</b></label>
                                <select class="form-select">
                                    <option selected>Select industry</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}"
                                            {{ $company->industry_id == $industry->id ? 'selected' : '' }}>
                                            {{ $industry->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><b>ASSIGNEE</b></label>
                                <select class="form-select">
                                    <option selected>Select an assignee</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $company->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label"><b>TERRITORY</b></label>
                                <select class="form-select">
                                    <option selected>Select territory</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label"><b>ANNUAL RE.</b></label>
                                        <input type="text" class="form-control" placeholder="Enter annual revenue">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label"><b>NU. OF EMPLOYEE</b></label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter number of employees">
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="text-warning small toggle-inline-detail" style="cursor: pointer;">
                                        Add email, phone, url, or address
                                    </div>
                                </div>

                                <div class="col-12 mt-2 inline-detail-input" style="display: none;">
                                    <input type="text" name="inline_detail" class="form-control"
                                        placeholder="Enter an email, phone number, address, etc">
                                </div>


                            </div>
                        </form>
                        {{-- Company section form end --}}

                        <hr>


                        <div class="sidebar-section">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="form-label">ADDRESS</h6>
                                <div>
                                    <i class="fas fa-edit text-muted me-2"></i>
                                    <i class="fas fa-times text-muted"></i>
                                </div>
                            </div>
                            {{-- <p class="small">1001 12th St.<br>
                                Shallowater TX 79363 US</p> --}}
                            <p class="small">{{ $company->address ?? 'N/A' }}</p>
                        </div>
                        <hr>
                        <div class="sidebar-section">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="form-label">OFFICE</h6>
                                <div>
                                    <i class="fas fa-edit text-muted me-2"></i>
                                    <i class="fas fa-times text-muted"></i>
                                </div>
                            </div>
                            <p class="small">{{ $company->phone ?? 'N/A' }}</p>
                        </div>
                        <hr>
                        <div class="sidebar-section">
                            <h6 class="form-label">ATTACHED FILES</h6>
                            <button class="btn btn-outline-secondary w-100">
                                <i class="fas fa-upload me-2"></i>Upload File
                            </button>
                        </div>

                        <div class="sidebar-section">
                            <h6 class="form-label">COMPANY HIERARCHY</h6>
                            <button class="btn btn-outline-secondary w-100">
                                Upgrade <i class="fas fa-arrow-up ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Lead Modal Start -->
    <div class="modal fade" id="AddLead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Add a lead</h1>
                    <div>
                        <a href="#" class="link-decoration">Customize fields</a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                </div>
                <div class="modal-body">

                    {{-- <form class="company-form" id="add-lead-form"> --}}
                    <form action="{{ route('admin.leads.store') }}" class="company-form" id="add-lead-form"
                        method="POST">
                        @csrf


                        <div class="row mx-0">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Lead name</label>
                                    @error('name')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    <input type="text" name="name" placeholder="Lead Name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Assignee</label>
                                    @error('assignee_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    <select name="assignee_id" class="form-select">
                                        <option value="">Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Anticipated closed date</label>
                                    @error('close_date')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    <input type="text" name="close_date" placeholder="04-Apr-2004"
                                        class="form-control" />
                                </div>
                            </div>

                            <!-- Product Row Container -->
                            <div id="productRowContainer" class="mt-3">
                                <div class="row product-row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Products</label>
                                            <select class="form-select mt-2" name="product_id[]">
                                                <option value="">Choose...</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Qty :</label>
                                            <input type="number" name="quantity[]" placeholder="Add quantity"
                                                class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group d-flex justify-content-between align-items-end">
                                            <div style="width: 100%">
                                                <label class="form-label fw-light">U.S(USD)</label>
                                                <input type="number" name="price[]" step="0.01"
                                                    placeholder="Add price" class="form-control" />
                                            </div>
                                            <button type="button"
                                                class="btn btn-danger btn-sm ms-2 remove-product-row">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add New Product Button -->
                            <button type="button" id="addProductRow"
                                class="btn btn-sm btn-link text-primary text-start">
                                + Add New Product
                            </button>

                            <div class="col-lg-12 mt-2">
                                <div class="form-group">
                                    <label class="form-label">Confidence</label>
                                    @error('confidence')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    <input type="number" name="confidence" placeholder="Confidence %"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Companies</label>
                                    @error('company_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    {{-- <select name="company_id[]" id="companySelect" class="form-select">
                                        @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select name="company_id[]" id="companySelect" class="form-select" multiple>
                                        <option value="">Choose Company</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Select Person</label>
                                    @error('person_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    <select id="person_select" name="person_id[]" class="form-select" multiple>
                                        <option value="">-- Select Person --</option>
                                        @foreach ($allpeoples as $allpeople)
                                            <option value="{{ $allpeople->id }}">{{ $allpeople->contact_name }}
                                                ({{ $allpeople->email }})
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Toggle Button --}}
                                    <button type="button" id="toggleAddPerson" class="btn btn-sm btn-link text-primary">
                                        + Add New Person
                                    </button>

                                    {{-- ====== --}}
                                    <div id="addPersonInlineForm" class="mt-3 p-3 border rounded bg-light d-none">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label>Name</label>
                                                <input type="text" name="inline_name" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Email</label>
                                                <input type="email" name="inline_email" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Phone</label>
                                                <input type="text" name="inline_phone" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Code</label>
                                                <input type="text" name="inline_code" class="form-control">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success mt-2" id="submitAddPerson">Add
                                            Person</button>
                                    </div>


                                    {{-- ===== --}}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Sources</label>
                                    @error('source_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    <select id="source_select" name="source_id[]" class="form-select mt-2" multiple>
                                        <option value="">Choose...</option>
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}">
                                                {{ $source->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Competitors</label>
                                    @error('competitors_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                    @enderror
                                    <select id="competitor_select" name="competitors_id[]" class="form-select mt-2"
                                        multiple>
                                        <option value="">Choose...</option>
                                        @foreach ($competitors as $competitor)
                                            <option value="{{ $competitor->id }}">
                                                {{ $competitor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- div=row mx-0 closed --}}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create lead</button>
                        </div>
                    </form>
                    {{-- form closed --}}

                </div>
            </div>
        </div>
    </div>
    {{-- Lead modal end --}}

    {{-- Activities modal --}}
    <div class="modal fade" id="schedule-activity" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Schedule Activity</h1>
                    <div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body ps-0">

                    <form class="company-form" action="{{ route('admin.activity.store') }}" method="post"
                        id="store_activity">
                        @csrf
                        {{-- Hidden field for storing  company id --}}
                        <input type="hidden" name="company_id" value="{{ $company->id }}">

                        <div class="row mx-0">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Activity Title</label>
                                    <input type="text" placeholder="Phone Call" name="title"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Activity type</label>
                                    <select class="form-select mt-2" name="activity_type_id">
                                        <option selected>Choose...</option>
                                        @foreach ($activity_types as $activity_type)
                                            <option value="{{ $activity_type->id }}">
                                                {{ $activity_type->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">Date</label>
                                    <input type="date" placeholder="" class="form-control" name="date" />
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="form-label">Time</label>
                                    <div class="d-flex">
                                        <select class="form-select mt-2" name="start_time">
                                            <option value="11:00 AM" selected>11 : 00 AM</option>
                                            <option value="11:15 AM">11 : 15 AM</option>
                                            <option value="11:30 AM">11 : 30 AM</option>
                                            <option value="11:45 AM">11 : 45 AM</option>
                                        </select>
                                        <select class="form-select mt-2" name="end_time">
                                            <option value="01:11 PM" selected>01 : 11 PM (3 min)</option>
                                            <option value="01:15 PM">01 : 15 PM (15 min)</option>
                                            <option value="01:30 PM">01 : 30 PM (30 min)</option>
                                            <option value="01:45 PM">01 : 45 PM (45 min)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                        name="all_day">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        All day
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="form-label">Location</label>
                                    <input type="text" placeholder="Add a Location" class="form-control"
                                        name="location" />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="form-label">Participant </label>
                                    <input type="text" placeholder="Type to search for participants…"
                                        class="form-control" name="search_participant" />
                                </div>
                                <div class="participant-list">

                                    @foreach ($allpeoples as $allpeople)
                                        <div
                                            class="d-flex align-items-center justify-content-between mb-3 participant-entry">
                                            <div class="d-flex align-items-center">
                                                {{-- <img src="img/home/profile.png" alt="Paul Blake" class="person-avatar me-3"> --}}
                                                <div>
                                                    <input type="hidden" name="participant_id[]"
                                                        value="{{ $allpeople->id }}">
                                                    <h6 class="mb-0">{{ $allpeople->contact_name }}</h6>
                                                    <small class="text-warning">{{ $allpeople->email }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-3 align-items-center">
                                                <div class="text-end">
                                                    <a href="#" class="remove-participant"><i
                                                            class="fa-regular fa-xmark"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <textarea rows="5" placeholder="Add an agenda to share with your attendees" class="form-control"
                                    name="agenda"></textarea>
                            </div>

                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="AddActivity">Create activity</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Activities modal end --}}


@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Handle checkbox selection
        // const selectAllCheckbox = document.getElementById('selectAll');
        // const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        // const actionBar = document.getElementById('actionBar');
        // const selectedCount = document.getElementById('selectedCount');

        // function updateActionBar() {
        //     const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        //     if (checkedBoxes.length > 0) {
        //         actionBar.classList.add('show');
        //         selectedCount.textContent = checkedBoxes.length;
        //     } else {
        //         actionBar.classList.remove('show');
        //     }
        // }

        // // Initialize with first row checked
        // updateActionBar();

        // selectAllCheckbox.addEventListener('change', function () {
        //     rowCheckboxes.forEach(checkbox => {
        //         checkbox.checked = selectAllCheckbox.checked;
        //     });
        //     updateActionBar();
        // });

        // rowCheckboxes.forEach(checkbox => {
        //     checkbox.addEventListener('change', function () {
        //         const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
        //         const someChecked = Array.from(rowCheckboxes).some(cb => cb.checked);

        //         selectAllCheckbox.checked = allChecked;
        //         selectAllCheckbox.indeterminate = someChecked && !allChecked;

        //         updateActionBar();
        //     });
        // });

        // // Table row hover effects
        // const tableRows = document.querySelectorAll('tbody tr');
        // tableRows.forEach(row => {
        //     row.addEventListener('mouseenter', function () {
        //         this.style.backgroundColor = '#f8f9fa';
        //     });
        //     row.addEventListener('mouseleave', function () {
        //         this.style.backgroundColor = '';
        //     });
        // });

        // $(document).on('click', '.remove-participant', function(e) {
        //     e.preventDefault();
        //     $(this).closest('.participant-entry').remove();
        // });

        // =============== Create a lead related logic STARTS =============================

        function addLead() {
            $('#AddLead').modal('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const choicesConfig = {
                removeItemButton: true,
                placeholder: true,
                shouldSort: false,
            };

            const selects = [{
                    id: 'companySelect',
                    search: 'Search Companies...'
                },
                {
                    id: 'person_select',
                    search: 'Search Person...'
                },
                {
                    id: 'source_select',
                    search: 'Search Source...'
                },
                {
                    id: 'competitor_select',
                    search: 'Search Competitor...'
                },
            ];

            selects.forEach(select => {
                const element = document.getElementById(select.id);
                if (element) {
                    new Choices(element, {
                        ...choicesConfig,
                        // placeholderValue: select.placeholder,
                        searchPlaceholderValue: select.search
                    });
                }
            });
        });

        $(document).on('click', '.remove-participant', function(e) {
            e.preventDefault();
            $(this).closest('.participant-entry').remove();
        });

        // Toggle the Add Person form
        $('#toggleAddPerson').on('click', function() {
            $('#addPersonInlineForm').toggleClass('d-none');
        });

        // Product row logic
        $('#addProductRow').click(function() {
            var row = $('.product-row:first').clone(); // Clone the first row
            row.find('input').val(''); // Clear inputs
            row.find('select').val(''); // Clear dropdown
            $('#productRowContainer').append(row); // Append to container
        });

        // Remove a specific product row
        $(document).on('click', '.remove-product-row', function() {
            if ($('.product-row').length > 1) {
                $(this).closest('.product-row').remove();
            } else {
                alert('At least one product row is required.');
            }
        });



        // Submit Add Person via AJAX
        $('#submitAddPerson').on('click', function() {
            let formData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: $('input[name="inline_name"]').val(),
                email: $('input[name="inline_email"]').val(),
                phone: $('input[name="inline_phone"]').val(),
                code: $('input[name="inline_code"]').val(),
            };

            $.ajax({
                url: "{{ route('admin.people.ajax.store') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        toastr.success('Person added successfully!');
                        $('input[name="inline_name"], input[name="inline_email"], input[name="inline_phone"], input[name="inline_code"]')
                            .val('');
                        $('#addPersonInlineForm').addClass('d-none');

                        const newPerson = response.people;
                        const option = new Option(newPerson.email, newPerson.id);
                        $('#person_select').append(option);

                    } else {
                        console.log(response);
                        toastr.error('Failed to add person. Please try again.');
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON?.errors) {
                        let messages = Object.values(xhr.responseJSON.errors).flat().join(
                            '\n');
                        toastr.error(messages, 'Validation Error');
                    } else {
                        console.log(xhr.responseText);
                        toastr.error("Something went wrong.");
                    }
                }
            });
        });


        $("#add-lead-form").validate({
            ignore: [],
            rules: {
                name: {
                    required: true
                },
                assignee_id: {
                    required: true
                },
                close_date: {
                    required: true
                },
                "product_id[]": {
                    required: true
                },
                "quantity[]": {
                    required: true
                },
                "price[]": {
                    required: true
                },
                confidence: {
                    required: true
                },
                "company_id[]": {
                    required: true
                },
                "person_id[]": {
                    required: true
                },
                "source_id[]": {
                    required: true
                },
                "competitors_id[]": {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter lead name."
                },
                assignee_id: {
                    required: "Please select an assignee."
                },
                close_date: {
                    required: "Please select a close date."
                },
                "product_id[]": {
                    required: "Please select a product."
                },
                "quantity[]": {
                    required: "Please enter the quantity."
                },
                "price[]": {
                    required: "Please enter the price."
                },
                confidence: {
                    required: "Please enter the confidence level."
                },
                "company_id[]": {
                    required: "Please select a company."
                },
                "person_id[]": {
                    required: "Please select a person."
                },
                "source_id[]": {
                    required: "Please select a source."
                },
                "competitors_id[]": {
                    required: "Please select a competitor."
                }
            },
            errorElement: 'span',
            errorClass: 'invalid-feedback d-block',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent()); // Inserts after the .input-group
                } else {
                    error.insertAfter(element); // Default
                }
            }
        });


        // Submit Lead form
        $('#add-lead-form').submit(function(e) {
            e.preventDefault();

            if (!$('#add-lead-form').valid()) {
                return; // Stop if validation fails
            }

            $.ajax({
                url: '{{ route('admin.leads.store') }}',
                method: 'POST',
                data: $(this).serialize(),

                success: function(response) {
                    toastr.success('Lead created successfully!');
                    $('#add-lead-form')[0].reset();
                    $('#AddLead').modal('hide');

                },
                error: function(xhr) {
                    alert(xhr.responseText);
                    toastr.error('Something went wrong while creating the lead.');
                }
            });
        });



        // =============== Create a lead related logic ENDS ========================


        const toggleBtn = document.getElementById('toggleAddPeople');
        const formDiv = document.getElementById('addPeopleForm');

        const toggleTaskBtn = document.getElementById('toggleAddTask');
        const formTaskDiv = document.getElementById('addTaskForm');

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (formDiv.style.display === "none" || formDiv.style.display === "") {
                formDiv.style.display = "block";
            } else {
                formDiv.style.display = "none";
            }
        });

        toggleTaskBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (formTaskDiv.style.display === "none" || formTaskDiv.style.display === "") {
                formTaskDiv.style.display = "block";
            } else {
                formTaskDiv.style.display = "none";
            }
        });

        // =========== Add Task ajax form validation and submition logic STARTS ==============
        $("#addTaskAjaxForm").validate({
            ignore: [],
            rules: {
                title: {
                    required: true
                },
                due_date: {
                    required: true
                },
                user_id: {
                    required: true
                },
                description: {
                    required: true
                },

            },
            messages: {
                name: {
                    required: "Please enter the task name."
                },
                due_date: {
                    required: "Please enter the due date."
                },
                user_id: {
                    required: "Please select the user."
                },
                description: {
                    required: "Please enter the description."
                },

            },
            errorElement: 'span',
            errorClass: 'invalid-feedback d-block',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent()); // Inserts after the .input-group
                } else {
                    error.insertAfter(element); // Default
                }
            }
        });


        $('#addTaskAjaxForm').submit(function(e) {
            e.preventDefault();

            if (!$('#addTaskAjaxForm').valid()) {
                return; // Stop if validation fails
            }

            $.ajax({
                url: "{{ route('admin.tasks.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert('Task added successfully!');
                    $('#addTaskAjaxForm')[0].reset();
                    console.log(response);
                    location.reload();

                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                    toastr.error('Something went wrong while adding the task.');
                }
            });
        });

        // =========== Add Task ajax form validation and submition logic ENDS ==============


        // =========== Add Person ajax form validation and submition logic STARTS ==============
        $("#addPeopleAjaxForm").validate({
            ignore: [],
            rules: {
                contact_name: {
                    required: true
                },
                job_title: {
                    required: true
                },
                phone: {
                    required: true
                },
                email: {
                    required: true
                },
                description: {
                    required: true
                },

            },
            messages: {
                contact_name: {
                    required: "Please enter the Contact name."
                },
                job_title: {
                    required: "Please enter the job title."
                },
                phone: {
                    required: "Please enter the phone number."
                },
                email: {
                    required: "Please enter the email."
                },
                description: {
                    required: "Please enter the description."
                },

            },
            errorElement: 'span',
            errorClass: 'invalid-feedback d-block',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent()); // Inserts after the .input-group
                } else {
                    error.insertAfter(element); // Default
                }
            }
        });

        $('#addPeopleAjaxForm').submit(function(e) {
            e.preventDefault();

            if (!$('#addPeopleAjaxForm').valid()) {
                return; // Stop if validation fails
            }

            $.ajax({
                url: "{{ route('admin.people.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {

                    alert('People added successfully.');
                    $('#addPeopleAjaxForm')[0].reset();
                    console.log(response);
                    location.reload();

                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                    toastr.error('Something went wrong while adding the person.');

                }
            });
        });

        // =========== Add Person ajax form validation and submition logic ENDS ==============


        // =========== Schedule activity validation and submition logic STARTS ==============
        function scheduleActivity() {
            $('#schedule-activity').modal('show');
        }

        $("#store_activity").validate({
            ignore: [],
            rules: {
                title: {
                    required: true
                },
                activity_type_id: {
                    required: true
                },
                date: {
                    required: true
                },
                start_time: {
                    required: true
                },
                end_time: {
                    required: true
                },
                location: {
                    required: true
                },
                agenda: {
                    required: true
                },
            },
            messages: {
                title: {
                    required: "Please enter the title."
                },
                activity_type_id: {
                    required: "Please select an activity."
                },
                date: {
                    required: "Please enter the date."
                },
                start_time: {
                    required: "Please enter the time."
                },
                end_time: {
                    required: "Please enter the time."
                },
                location: {
                    required: "Please enter the location."
                },
                agenda: {
                    required: "Please enter the agenda."
                },

            },
            errorElement: 'span',
            errorClass: 'invalid-feedback d-block',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent()); // Inserts after the .input-group
                } else {
                    error.insertAfter(element); // Default
                }
            }
        });

        // Submit Activity form
        $('#store_activity').submit(function(e) {
            e.preventDefault();

            if (!$('#store_activity').valid()) {
                return; // Stop if validation fails
            }

            $.ajax({
                url: '{{ route('admin.activity.store') }}',
                method: 'POST',
                data: $(this).serialize(),

                success: function(response) {
                    toastr.success('Activity added successfully!');
                    $('#store_activity')[0].reset();
                    $('#AddActivity').modal('hide');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    toastr.error('Something went wrong while adding the activity.');
                }
            });
        });

        // =========== Schedule activity validation and submition logic ENDS ==============



        function deletePerson(person_id) {
            var deleteurl = "{{ route('admin.people.delete', ':people_id') }}".replace(':people_id', person_id);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete route
                    window.location.href = deleteurl;
                }
            });
        }

        $(document).ready(function() {

            $(document).on('click', '.remove-participant', function(e) {
                e.preventDefault();
                $(this).closest('.participant-entry').remove();
            });


            $('.toggle-inline-detail').on('click', function() {
                $('.inline-detail-input').toggle(); // smooth animation
            });
        });

        $("#loginActivity").validate({
            ignore: [],
            rules: {
                title: {
                    required: true
                },
                activity_type: {
                    required: true
                },
                duration: {
                    required: true
                },

            },
            messages: {
                title: {
                    required: "Please enter the title."
                },
                activity_type: {
                    required: "Please select the activity."
                },
                duration: {
                    required: "Please select the duration."
                },

            },
            errorElement: 'span',
            errorClass: 'invalid-feedback d-block',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent()); // Inserts after the .input-group
                } else {
                    error.insertAfter(element); // Default
                }
            }
        });


        $('#loginActivity').submit(function(e) {
            e.preventDefault();

            if (!$('#loginActivity').valid()) {
                return; // Stop if validation fails
            }

            $.ajax({
                url: "{{ route('admin.login.activity') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert('Logged an activity successfully!');
                    $('#loginActivity')[0].reset();
                    console.log(response);
                    location.reload();

                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                    toastr.error('Something went wrong while logging an activity.');
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const durationSelect = document.getElementById('duration');
            const startInput = document.getElementById('start_time');
            const endInput = document.getElementById('end_time');

            durationSelect.addEventListener('change', function() {
                const durationMinutes = parseInt(this.value);
                const now = new Date();

                const pad = n => String(n).padStart(2, '0');
                const formatTime = date => `${pad(date.getHours())}:${pad(date.getMinutes())}:00`;

                const end = new Date(now.getTime() + durationMinutes * 60000);

                startInput.value = formatTime(now);
                endInput.value = formatTime(end);
            });

            // Trigger default duration on load (optional)
            durationSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endpush
