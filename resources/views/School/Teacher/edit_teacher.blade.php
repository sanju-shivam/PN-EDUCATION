@extends('layouts.master')
@section('title2','Teacher')
@section('title3','Add Teacher')
@section('content')
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Teacher</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ route('teacher.update',$teacher->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Name
                                <sub style="color: red;font-size: 20px;">*</sub>
                            </label>
                            <input type="text" name="name" value="{{ $teacher->name }}" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                        	<label >Profile Picture</label>
                        	<div class="custom-file">
                                <input type="file" name="image" class="custom-file-input form-control" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>

                            </div>
                        </div>
                        <div class="form-group">
                            <label >Address</label>
                            <input type="text" name="address" value="{{ $teacher->address }}" class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label >City</label>
                            <input type="text" name="city" value="{{ $teacher->city }}" class="form-control" placeholder="Enter City">
                        </div>
                        <div class="form-group">
                            <label >State</label>
                            <input type="text" name="state" value="{{ $teacher->state }}" class="form-control" placeholder="Enter State">
                        </div>
                        <div class="form-group">
                            <label >PIN-CODE</label>
                            <input type="number"  name="pin_code" value="{{ $teacher->pin_code }}" class="form-control" placeholder="Enter PIN-CODE" >
                        </div>
                        <div class="form-group">
                            <label >Phone Number
                                <sub style="color: red;font-size: 20px;">*</sub>
                            </label>
                            <input type="number"  name="phone_no" value="{{ $teacher->phone_no }}" class="form-control" placeholder="Enter Phone Number" >
                        </div>
                        <div class="form-group">
                            <label >Email
                                <sub style="color: red;font-size: 20px;">*</sub>
                            </label>
                            <input type="email" name="email" value="{{ $teacher->email }}" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label >Password
                                <sub style="color: red;font-size: 20px;">*</sub>
                            </label>
                            <input type="password" name="password" value="{{ $teacher->password }}" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label >Aadhar Number</label>
                            <input type="alpha_num" name="id_proof" value="{{ $teacher->aa }}" class="form-control" placeholder="Enter Affilation Number">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection