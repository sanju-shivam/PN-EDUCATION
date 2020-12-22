@extends('layouts.master')
@section('title2','School')
@section('title3','Show School')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="profile-cover">
                <img src="{{ asset('schools/logo/'.$school->logo) }}" height="400">
            </div>
            <div class="profile-header">
                <div class="profile-name">
                    <h3 class="text-uppercase">{{ $school->name }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Address</h5>
                    <p>{{ $school->address }}</p>
                    <ul class="list-unstyled profile-about-list">
                        <li>City&nbsp; : &nbsp;{{ $school->city }}</li>
                        <li>State&nbsp; : &nbsp;{{ $school->state }}</li>
                        <li>Pin-Code&nbsp; : &nbsp;{{ $school->pin_code }}</li>
                        <li>
                            <a href="{{ url('school/'.$school->id.'/edit') }}" class="btn btn-block btn-primary m-t-lg" style="color: white;">Edit</a>

                            <a href="{{ url('school/delete/'.$school->id) }}" class="btn btn-block btn-secondary m-t-lg">Delete</a>
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
                                <span class="post-author">Students Registered</span><br>
                            </div>
                            
                        </div>
                        <div class="post-body">
                            <p>Proin eu fringilla dui. Pellentesque mattis lobortis mauris eu tincidunt. Maecenas hendrerit faucibus dolor, in commodo lectus mattis ac.</p>
                            
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
                                <span class="post-author">Teacher Registered</span><br>
                            </div>
                            
                        </div>
                        <div class="post-body">
                            <p>Proin eu fringilla dui. Pellentesque mattis lobortis mauris eu tincidunt. Maecenas hendrerit faucibus dolor, in commodo lectus mattis ac.</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">
        	<div class="card">
                <div class="card-body">
                    <h5 class="card-title">School info</h5>
                    <ul class="list-unstyled profile-about-list">
                        <li>Board Name&nbsp; : &nbsp; {{ $school->board_name }}</li>
                        <li>Affilation No&nbsp; : &nbsp;{{ $school->affilation_no }}</li>
                        <li>Status &nbsp; : &nbsp;
                        	 @if($school->status == 1) 
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
                    <h5 class="card-title">Contact Info</h5>
                    <ul class="list-unstyled profile-about-list">
                        <li>Email&nbsp; : &nbsp; {{ $school->email }}</li>
                        <li>Phone&nbsp; : &nbsp;{{ $school->phone_no }}</li>
                    </ul>
                </div>
            </div>     
        </div>
    </div>
</div><!-- Main Wrapper -->

@endsection