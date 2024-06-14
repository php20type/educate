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
                    <h4>User Management</h4>
                 </div>
                </div>
            </div>
           <div class="top-header-rightmenu">
            {{-- <form class="search-bar position-relative me-2" id="" accept="">
                <input type="text" name="" id="" placeholder="Type Here..." class="form-control">
                <i class="fa-regular fa-magnifying-glass"></i>
            </form> --}}
            <div class="profile-dropdown">
                <ul class="list-inline mb-0">
                    @auth
                        <li class="list-inline-item">
                            <a href="#" data-bs-toggle="dropdown" class="dropdown">
                                <p><i class="fa-solid fa-user me-1"></i> {{ auth()->user()->first_name }}</p>
                            </a>
                            <ul class="dropdown-menu border-light-subtle py-3">
                                <li class="mb-3">
                                    <a class="dropdown-item border-bottom-1" href="{{ route('user.edit',auth()->user()->id) }}">
                                        <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0001 20C8.48816 20.0043 6.99532 19.6622 5.6361 19C5.13865 18.758 4.66203 18.4754 4.2111 18.155L4.0741 18.055C2.83392 17.1396 1.81997 15.9522 1.1101 14.584C0.375836 13.1679 -0.00499271 11.5952 4.94229e-05 10C4.94229e-05 4.47715 4.47725 0 10.0001 0C15.5229 0 20.0001 4.47715 20.0001 10C20.0051 11.5944 19.6247 13.1664 18.8911 14.582C18.1822 15.9494 17.1697 17.1364 15.9311 18.052C15.4639 18.394 14.968 18.6951 14.4491 18.952L14.3691 18.992C13.009 19.6577 11.5144 20.0026 10.0001 20ZM10.0001 15C8.50158 14.9971 7.12776 15.834 6.4431 17.167C8.68449 18.2772 11.3157 18.2772 13.5571 17.167V17.162C12.8716 15.8305 11.4977 14.9954 10.0001 15ZM10.0001 13C12.1662 13.0028 14.1635 14.1701 15.2291 16.056L15.2441 16.043L15.2581 16.031L15.2411 16.046L15.2311 16.054C17.7601 13.8691 18.6644 10.3423 17.4987 7.21011C16.3331 4.07788 13.3432 2.00032 10.0011 2.00032C6.65901 2.00032 3.66909 4.07788 2.50345 7.21011C1.33781 10.3423 2.2421 13.8691 4.7711 16.054C5.83736 14.169 7.83446 13.0026 10.0001 13ZM10.0001 12C7.79096 12 6.0001 10.2091 6.0001 8C6.0001 5.79086 7.79096 4 10.0001 4C12.2092 4 14.0001 5.79086 14.0001 8C14.0001 9.06087 13.5787 10.0783 12.8285 10.8284C12.0784 11.5786 11.061 12 10.0001 12ZM10.0001 6C8.89553 6 8.0001 6.89543 8.0001 8C8.0001 9.10457 8.89553 10 10.0001 10C11.1047 10 12.0001 9.10457 12.0001 8C12.0001 6.89543 11.1047 6 10.0001 6Z" fill="#4DA6FF"/>
                                        </svg>                        
                                        Profile 
                                    </a>
                                </li>
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
                    @else
                        <li class="list-inline-item">
                            <a href="{{ route('login') }}">
                                <p><i class="fa-solid fa-user me-1"></i> Sign In</p>
                            </a>
                        </li>
                    @endauth

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

    <!-- table user start -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-billing"> 
        {{-- <div class="top-search-bar mb-4">
            <div class="row">
                 <div class="col-lg-6">
                     <form class="search-form position-relative" id="">
                        <div class="row">
                         
                            <div class="col-lg-6 position-relative"> 
                                <input type="text" name="" id="" placeholder="Type Here..." class="form-control">
                                <i class="fa-regular fa-magnifying-glass"></i>
                            </div>
                        </div>
                     </form>
                 </div>
                 <div class="col-lg-6">
                    <div class="filter-sec">
                        <a href="#" class="btn btn-outline-primary"><svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.4313 10.125V18H7.93125V10.125L0 0H20.3625L12.4313 10.125ZM10.1813 9.3375L15.75 2.25H4.6125L10.1813 9.3375Z" fill="#0384FE"/>
                            </svg>
                        </a>
                        <a href="#" class="btn btn-outline-primary"><svg width="25" height="15" viewBox="0 0 25 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.36751 10.3623L5.00502 10.7373V1.24998C5.00502 0.918462 4.87332 0.600526 4.63891 0.36611C4.40449 0.131694 4.08656 0 3.75504 0C3.42353 0 3.10559 0.131694 2.87118 0.36611C2.63676 0.600526 2.50507 0.918462 2.50507 1.24998V10.7373L2.14257 10.3623C1.9072 10.1269 1.58796 9.99469 1.25509 9.99469C0.92222 9.99469 0.602982 10.1269 0.367607 10.3623C0.132232 10.5977 0 10.9169 0 11.2498C0 11.5827 0.132232 11.9019 0.367607 12.1373L2.86756 14.6372C2.98644 14.751 3.12661 14.8402 3.28005 14.8997C3.42967 14.9658 3.59146 15 3.75504 15C3.91863 15 4.08041 14.9658 4.23003 14.8997C4.38347 14.8402 4.52365 14.751 4.64252 14.6372L7.14248 12.1373C7.25902 12.0207 7.35147 11.8824 7.41455 11.7301C7.47762 11.5778 7.51008 11.4146 7.51008 11.2498C7.51008 11.085 7.47762 10.9218 7.41455 10.7695C7.35147 10.6172 7.25902 10.4788 7.14248 10.3623C7.02593 10.2458 6.88757 10.1533 6.7353 10.0902C6.58302 10.0272 6.41981 9.99469 6.25499 9.99469C6.09017 9.99469 5.92697 10.0272 5.77469 10.0902C5.62242 10.1533 5.48406 10.2458 5.36751 10.3623ZM11.2549 2.49995H23.7547C24.0862 2.49995 24.4041 2.36826 24.6385 2.13384C24.8729 1.89943 25.0046 1.58149 25.0046 1.24998C25.0046 0.918462 24.8729 0.600526 24.6385 0.36611C24.4041 0.131694 24.0862 0 23.7547 0H11.2549C10.9234 0 10.6054 0.131694 10.371 0.36611C10.1366 0.600526 10.0049 0.918462 10.0049 1.24998C10.0049 1.58149 10.1366 1.89943 10.371 2.13384C10.6054 2.36826 10.9234 2.49995 11.2549 2.49995ZM23.7547 6.24988H11.2549C10.9234 6.24988 10.6054 6.38157 10.371 6.61599C10.1366 6.8504 10.0049 7.16834 10.0049 7.49986C10.0049 7.83137 10.1366 8.14931 10.371 8.38372C10.6054 8.61814 10.9234 8.74983 11.2549 8.74983H23.7547C24.0862 8.74983 24.4041 8.61814 24.6385 8.38372C24.8729 8.14931 25.0046 7.83137 25.0046 7.49986C25.0046 7.16834 24.8729 6.8504 24.6385 6.61599C24.4041 6.38157 24.0862 6.24988 23.7547 6.24988ZM23.7547 12.4998H11.2549C10.9234 12.4998 10.6054 12.6315 10.371 12.8659C10.1366 13.1003 10.0049 13.4182 10.0049 13.7497C10.0049 14.0812 10.1366 14.3992 10.371 14.6336C10.6054 14.868 10.9234 14.9997 11.2549 14.9997H23.7547C24.0862 14.9997 24.4041 14.868 24.6385 14.6336C24.8729 14.3992 25.0046 14.0812 25.0046 13.7497C25.0046 13.4182 24.8729 13.1003 24.6385 12.8659C24.4041 12.6315 24.0862 12.4998 23.7547 12.4998Z" fill="#0384FE"/>
                            </svg>                                
                        </a>
                    </div>
                 </div>
            </div>
        </div> --}}
        <div class="table-responsive"> 
        <table class="table table-dark table-bordered" id="userTable">
        <thead>
          <tr>
            <th scope="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        User Name
                    </label>
              </div>
            </th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Plan</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $user)      
          <tr data-href="{{ route('user.edit', $user->id) }}">
            <td> 
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="user1">
                <label class="form-check-label" for="user1">
                    {{ $user->first_name }} {{ $user->last_name  }}
                </label>
            </div>
           </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>-</td>
           <td>
                <div class="form-check form-switch">
                    <input class="form-check-input user-switch" type="checkbox" role="switch" id="flexSwitchCheckDefault{{ $user->id }}" {{ $user->is_active ? 'checked' : '' }} data-user-id="{{ $user->id }}">
                    <label class="form-check-label" for="flexSwitchCheckDefault{{ $user->id }}"></label>
                </div>
            </td>
            <td>
                <div class="action-btn">
                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3937 3.00652L13.1587 4.77069M12.5287 1.45236L7.7562 6.22486C7.5096 6.4711 7.34143 6.78484 7.27286 7.12652L6.83203 9.33319L9.0387 8.89152C9.38036 8.82319 9.6937 8.65569 9.94036 8.40902L14.7129 3.63652C14.8563 3.49311 14.97 3.32285 15.0477 3.13547C15.1253 2.94809 15.1652 2.74726 15.1652 2.54444C15.1652 2.34162 15.1253 2.14079 15.0477 1.95341C14.97 1.76603 14.8563 1.59577 14.7129 1.45236C14.5695 1.30894 14.3992 1.19518 14.2118 1.11756C14.0244 1.03995 13.8236 1 13.6208 1C13.418 1 13.2171 1.03995 13.0297 1.11756C12.8424 1.19518 12.6721 1.30894 12.5287 1.45236V1.45236Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.5 10.9998V13.4998C13.5 13.9419 13.3244 14.3658 13.0118 14.6783C12.6993 14.9909 12.2754 15.1665 11.8333 15.1665H2.66667C2.22464 15.1665 1.80072 14.9909 1.48816 14.6783C1.17559 14.3658 1 13.9419 1 13.4998V4.33317C1 3.89114 1.17559 3.46722 1.48816 3.15466C1.80072 2.8421 2.22464 2.6665 2.66667 2.6665H5.16667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#" class="btn"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.7551 7.10204C15.6735 6.28572 15.102 5.55102 14.3673 5.30612C14.3673 5.06122 14.3673 4.73469 14.2857 4.40816C14.2041 3.59184 13.551 2.85714 12.7347 2.69388C12.7347 2.53061 12.7347 2.28571 12.6531 2.04082C12.5714 0.979592 11.6735 0.163265 10.6122 0.0816326C9.87755 0.0816326 8.81633 0 8 0C7.18367 0 6.12245 0.0816326 5.38776 0.0816326C4.32653 0.163265 3.42857 0.979592 3.34694 2.04082C3.34694 2.28571 3.34694 2.44898 3.26531 2.69388C2.44898 2.93878 1.79592 3.59184 1.71429 4.40816C1.71429 4.73469 1.63265 5.06122 1.63265 5.30612C0.897959 5.55102 0.408163 6.28572 0.244898 7.10204C0.163265 8.08163 0 9.38776 0 10.449C0 11.5102 0.163265 12.8163 0.244898 13.7959C0.326531 14.8571 1.22449 15.6735 2.28571 15.7551C3.91837 15.8367 6.20408 16 8 16C9.79592 16 12.0816 15.8367 13.7143 15.7551C14.7755 15.6735 15.6735 14.8571 15.7551 13.7959C15.8367 12.8163 16 11.5102 16 10.449C16 9.38776 15.8367 8.08163 15.7551 7.10204ZM5.46939 1.38776C6.20408 1.38776 7.18367 1.30612 8 1.30612C8.81633 1.30612 9.79592 1.38776 10.5306 1.38776C11.0204 1.38776 11.3469 1.79592 11.4286 2.20408C11.4286 2.36735 11.4286 2.44898 11.4286 2.61225C10.3673 2.61225 9.06123 2.53061 8 2.53061C6.93878 2.53061 5.63265 2.53061 4.57143 2.61225C4.57143 2.44898 4.57143 2.36735 4.57143 2.20408C4.65306 1.71429 4.97959 1.38776 5.46939 1.38776ZM9.63266 11.102H8.65306V12.0816C8.65306 12.4082 8.40816 12.7347 8 12.7347C7.59184 12.7347 7.34694 12.4898 7.34694 12.0816V11.102H6.36735C6.04082 11.102 5.71429 10.8571 5.71429 10.449C5.71429 10.0408 5.95918 9.79592 6.36735 9.79592H7.34694V8.81633C7.34694 8.4898 7.59184 8.16327 8 8.16327C8.40816 8.16327 8.65306 8.40816 8.65306 8.81633V9.79592H9.63266C9.95919 9.79592 10.2857 10.0408 10.2857 10.449C10.2857 10.8571 9.95919 11.102 9.63266 11.102ZM8 4.89796C6.44898 4.89796 4.4898 4.97959 2.93878 5.06122C2.93878 4.89796 2.93878 4.73469 3.02041 4.4898C3.10204 4.08163 3.42857 3.7551 3.91837 3.7551C5.14286 3.67347 6.77551 3.67347 8.08163 3.67347C9.38776 3.67347 11.0204 3.7551 12.2449 3.7551C12.7347 3.7551 13.0612 4.08163 13.1429 4.4898C13.1429 4.65306 13.2245 4.89796 13.2245 5.06122C11.5102 5.06122 9.55102 4.89796 8 4.89796Z" fill="#0384FE"/>
                        </svg>                            
                    </a>
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{-- <div class="ed-pagination pt-2">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item disabled">
                <a class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
              </li> 
              <li class="page-item active">
                <a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#"> 1-7 of 1000</a>
              </li>
             
            </ul>
          </nav>
      </div> --}}
    </div>
     
    </div>
      <!-- table user end -->

</div>
@endsection
@section('page-script')
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "dom": '<"top"f>rt<"bottom"ip><"clear">',
            "pagingType": "full_numbers",
            "language": {
                "search": "",
                "searchPlaceholder": "Search records",
                "paginate": {
                    "first": "«",
                    "last": "»",
                    "next": "›",
                    "previous": "‹"
                }
            }
        });
    });
    // document.addEventListener('DOMContentLoaded', function() {
    //     const rows = document.querySelectorAll('tr[data-href]');
    //     rows.forEach(row => {
    //         row.addEventListener('click', function() {
    //             window.location.href = this.dataset.href;
    //         });
    //     });
    // });
    $('.user-switch').change(function() {
        var userId = $(this).data('user-id');
        var isActive = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '{{ url('/updateStatus') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: userId,
                is_active: isActive
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(xhr, status, error) {
                console.error('Error updating user status:', error);
            }
        });
    });
    
</script>

@endsection