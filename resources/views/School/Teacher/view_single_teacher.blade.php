@extends('layouts.master')
@section('title2','School')
@section('title3','Show School')
@section('content')

    <div id="message_success" style="display: none;" class="alert alert-success">
        <p>STATUS UPDATED SUCCESSFULLY</p>
    </div>
  

<div id="main-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="profile-cover">
                <img height="400" src='{{ asset("schools/$school_name/teachers/".$teacher->image) }}'>
            </div>
            <div class="profile-header">
                <div class="profile-name">
                    <h3 class="text-uppercase">{{ $teacher->name }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Address</h5>
                    <p>{{ $teacher->address }}</p>
                    <ul class="list-unstyled profile-about-list">
                        <li>City&nbsp; : &nbsp;{{ $teacher->city }}</li>
                        <li>State&nbsp; : &nbsp;{{ $teacher->state }}</li>
                        <li>Pin-Code&nbsp; : &nbsp;{{ $teacher->pincode }}</li>
                        <li>
                            <a href="{{ url('teacher/edit/'.$teacher->id) }}" class="btn btn-block btn-primary m-t-lg" style="color: white;">Edit</a>

                            <a href="{{ url('teacher/delete/'.$teacher->id) }}" class="btn btn-block btn-secondary m-t-lg">Delete</a>
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
                                <span class="post-author">Class Teacher</span><br>
                            </div>
                            
                        </div>
                        <div class="post-body">
                            <p>XYZ</p>
                            
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
                                <span class="post-author">Teacher Attendence</span><br>
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
                        <li>Board Name&nbsp; : &nbsp; {{ $teacher->board_name }}</li>
                        <li>Affilation No&nbsp; : &nbsp;{{ $teacher->affilation_no }}</li>
                        
                    </ul>
                </div>
            </div> -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contact Info</h5>
                        <ul class="list-unstyled profile-about-list">
                            <li>Email&nbsp; : &nbsp; {{ $teacher->email }}</li>
                            <li>Phone&nbsp; : &nbsp;{{ $teacher->phone_no }}</li>
                            <li>Status &nbsp; : &nbsp;
                                 @if($teacher->status == 0) 
                                    <button class=" btn badge badge-success">Active</button>
                                @else
                                    <button class=" btn  badge badge-danger">In-Active</button>
                                @endif 
                            </li>
                        </ul>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div><!-- Main Wrapper -->

@endsection

