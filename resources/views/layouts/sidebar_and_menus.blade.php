<div class="secondary-sidebar">
                    <div class="secondary-sidebar-bar">
                        <a href="#" class="logo-box" style="text-transform: uppercase;text-align: center;" >PNEDUCARE
                            {{--    @php  $a = explode(' ', Auth::user()->name,);
                                        echo $a[0]; 
                                    @endphp 
                            --}}
                        </a>
                    </div>
                    <div class="secondary-sidebar-menu">
                        <ul class="accordion-menu">
                            <li class="active-page">
                                <a href="">
                                    <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-apps"></i><span>Admins</span><i class="accordion-icon fas fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="">Add Admin</a></li>
                                    <li><a href="">View Admin</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>School</span><i class="accordion-icon fas fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('school.create') }}">Add School</a></li>
                                    <li><a href="{{ route('school.index') }}">View School</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i class="menu-icon icon-code"></i><span>Change Password</span>
                                </a>
                            </li>
                                    <!-- <li class="menu-divider"></li>--> 
                        </ul>
                    </div>
                </div>