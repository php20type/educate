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
                        {{-- <a href="#">
                            <p><i class="fa-solid fa-gear me-1"></i> </p>
                        </a> --}}
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <p><i class="fa-solid fa-bell me-1"></i> </p>
                        </a>
                    </li>
                   
                </ul>
               
            </div>