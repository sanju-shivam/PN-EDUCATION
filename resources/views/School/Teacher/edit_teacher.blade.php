@extends('layouts.master')
@section('title2','Teacher')
@section('title3','Add Teacher')
@section('content')
	<div class="row">
        <div class="col-xl">
             @if($errors->any())
        <div>
            <ul>
            @foreach($errors->all() as $error)
            <li class="alert alert-danger alert-dismissable list-unstyled">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             {{$error}}
            </li>
            @endforeach
            </ul>
        </div>    
        @endif
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
                            <input type="text" required name="name" required autocomplete="name" autofocus value="{{ $teacher->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                             @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        	<label >Profile Picture</label>
                        	<div class="custom-file">
                                <input type="file" name="image" class="custom-file-input form-control" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>

                                @if(!empty($teacher->image))
                                    <img height="100" width="100" src="{{ asset('schools/teachers/'.$teacher->image) }}">
                                @else
                                    NO IMAGE
                                @endif
                                <input type="hidden" name="current_image" value="{{ $teacher->image }}">

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
                            <input type="number"  name="pin_code" value="{{ $teacher->pincode }}" class="form-control" placeholder="Enter PIN-CODE" >
                        </div>
                        <div class="form-group">
                            <label >Phone Number
                                <sub style="color: red;font-size: 20px;">*</sub>
                            </label>
                            <input type="number" required  name="phone_no" autofocus="phone_no" autocomplete value="{{ $teacher->phone_no }}" class="form-control @error('phone_no') is-invalid @enderror" placeholder="Enter Phone Number" >
                             @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >Email
                                <sub style="color: red;font-size: 20px;">*</sub>
                            </label>
                            <input read-only type="email" required name="email" value="{{ $teacher->email }}" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label >Password
                                <sub style="color: red;font-size: 20px;">*</sub>
                            </label>
                            <input type="password" required name="password" autocomplete="password" autofocus value="{{ $teacher->password }}" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                             @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >Aadhar Number</label>
                            <input type="alpha_num" name="id_proof" required autocomplete="id_proof" autofocus value="{{ $teacher->id_proof }}" class="form-control @error('id_proof') is-invalid @enderror" placeholder="Enter Affilation Number">
                             @error('id_proof')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection