<div class="secondary-sidebar">
                    <div class="secondary-sidebar-bar">
                        <a href="#" class="logo-box" style="text-transform: uppercase;text-align: center;" > @php  $a = explode(' ', Auth::user()->name);
                                        echo $a[0]; 
                                    @endphp 
                            
                        </a>
                    </div>
                    <div class="secondary-sidebar-menu">
                        <ul class="accordion-menu">
                            <li class="active-page">
                                <a href="{{ url('/home') }}">
                                    <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                                </a>
                            </li>
                            @if(auth::user()->role_id ==1)
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
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>Class</span><i class="accordion-icon fas fa-angle-left"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('class.create') }}">Add Class</a></li>
                                        <li><a href="{{ route('class.index') }}">View Class</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>Subject</span><i class="accordion-icon fas fa-angle-left"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('subject.create') }}">Add Subject</a></li>
                                        <li><a href="{{ route('subject.index') }}">View Subject</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('deleted/school') }}">
                                        <i class="menu-icon icon-layers"></i><span>Deleted School</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('subject/deleted') }}">
                                        <i class="menu-icon icon-layers"></i><span>Deleted Subjects</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="menu-icon icon-code"></i><span>Change Password</span>
                                    </a>
                                </li>



                            @elseif(auth::user()->role_id ==2)  
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>Teacher</span><i class="accordion-icon fas fa-angle-left"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('teacher.create') }}">Add Teacher</a></li>
                                        <li><a href="{{ route('teacher.index') }}">View Teacher</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>Student</span><i class="accordion-icon fas fa-angle-left"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('student.create') }}">Add Student</a></li>
                                        <li><a href="{{ route('student.index') }}">View Student</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>Relation</span><i class="accordion-icon fas fa-angle-left"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:void(0)">
                                                Class , Teacher & Subject
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon icon-layers"></i><span>Deleted</span><i class="accordion-icon fas fa-angle-left"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('teacher.deleted.view') }}">Teacher</a></li>
                                        <li><a href="{{ route('student.deleted.view') }}">Student</a></li>
                                        <!-- <li><a href="{{ route('teacher.index') }}">View Teacher</a></li> -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="menu-icon icon-code"></i><span>Change Password</span>
                                    </a>
                                </li>
                            @endif
                                    <!-- <li class="menu-divider"></li>--> 
                        </ul>
                    </div>
                </div>