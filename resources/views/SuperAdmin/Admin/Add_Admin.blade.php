@extends('layouts.master')
@section('title2','Admin')
@section('title3','Add Admin')
@section('content')
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Admin</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                        	<label >Profile Image</label>
                        	<div class="custom-file">
                                <input type="file" name="profile_image" class="custom-file-input form-control" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label >School</label>
                        	<select name="institute_id" class="form-control custom-select">
                        		@foreach($schools as $school)
                                	<option value="{{ $school->id }}" >{{ $school->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label >Phone Number</label>
                            <input type="number"  name="phone_no" class="form-control" placeholder="Enter Phone Number" >
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label >Password</label>
                            <input type="password" name="password" class="form-control"placeholder="Enter Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection