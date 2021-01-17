@extends('layouts.master')
@section('title2','Student')
@section('title3','Show Student')
@section('content')

@php    
    $school_name = Cache::get('school_name_slug');
@endphp


<div id="main-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="profile-cover">
                <img height="400" src='{{ asset("schools/$school_name/students/".$student->image) }}'>
            </div>
            <div class="profile-header">
                <div class="profile-name">
                    <h3 class="text-uppercase">{{ $student->name }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Address</h5>
                    <p>{{ $student->address }}</p>
                    <ul class="list-unstyled profile-about-list">
                        <li>City&nbsp; : &nbsp;{{ $student->city }}</li>
                        <li>State&nbsp; : &nbsp;{{ $student->state }}</li>
                        <li>Pin-Code&nbsp; : &nbsp;{{ $student->pincode }}</li>
                        <li>
                            <a href="{{ url('student/edit/'.$student->id) }}" class="btn btn-block btn-primary m-t-lg" style="color: white;">Edit</a>

                            <a href="{{ url('student/delete/'.$student->id) }}" class="btn btn-block btn-secondary m-t-lg">Delete</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>

        <div class="col-md-3">
            <div class="card  alert-warning">
                <div class="card-body">
                    <div class="post">
                        <div class="post-header">
                            <div class="post-info">
                                <span class="post-author">Class</span><br>
                            </div>
                            
                        </div>
                        <div class="post-body">
                            <p>{{ $class_name }}</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card alert-primary">
                <div class="card-body">
                    <div class="post">
                        <div class="post-header">
                            <div class="post-info">
                                <span class="post-author">Attendence</span><br>
                            </div>
                            
                        </div>
                        <div class="post-body">
                            <p>Proin eu fringilla dui. Pellentesque mattis lobortis mauris eu tincidunt. Maecenas hendrerit faucibus dolor, in commodo lectus mattis ac.</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="col-md-3">
        	<div class="card">
                <div class="card-body">
                    <h5 class="card-title">School info</h5>
                    <ul class="list-unstyled profile-about-list">
                        <li>Board Name&nbsp; : &nbsp; {{ $student->board_name }}</li>
                        <li>Affilation No&nbsp; : &nbsp;{{ $student->affilation_no }}</li>
                        
                    </ul>
                </div>
            </div> -->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contact Info</h5>
                        <ul class="list-unstyled profile-about-list">
                            <li>Email&nbsp; : &nbsp; {{ $student->email }}</li>
                            <li>Phone&nbsp; : &nbsp;{{ $student->phone_no }}</li>
                            <li>Status &nbsp; : &nbsp;
                                 @if($student->status == 1) 
                                    <button class=" btn badge badge-success">Active</button>
                                @else
                                    <button class=" btn  badge badge-danger">In-Active</button>
                                @endif 
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Basic Info</h5>
                        <ul class="list-unstyled profile-about-list">
                            <li>Gender&nbsp; : &nbsp; @if($student->gender ==1) Male @elseif($student->gender ==2) Female @else Other @endif</li>
                            <li>DOB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;{{ $student->DOB }}</li>
                            
                        </ul>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div><!-- Main Wrapper -->

@endsection

