@extends('layouts.master')
@section('title2','Student')
@section('title3','Edit Student')
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
                    <h5 class="card-title">Edit Student</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ url('student/update/'.$student->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" value="{{ $student->name }}" class="form-control @error('name') is-invalid @enderror" required autocomplete="name" autofocus placeholder="Enter Name" >
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label >Phone Number</label>
                            <input type="alpha_num" maxlength="10"  name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" required autocomplete="phone_no" autofocus placeholder="Enter Phone Number" value="{{ $student->phone_no }}" >
                              @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                        </div>
                        <div class="form-group">
                            <label >Gender</label>
                            <select name="gender" class="form-control custom-select">
                                <option  value="">Select</option>
                                <option @if($student->gender ==1) selected @endif value="1">Male</option>
                                <option @if($student->gender ==2) selected @endif value="2">Female</option>
                                <option @if($student->gender ==3) selected @endif value="3">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Class Previously Selected (!!&nbsp;&nbsp; select new if previous is wrong only&nbsp;&nbsp; !!)</label>
                            <select disabled="" class="form-control custom-select">
                                <option value="">Select</option>
                                @foreach($classes as $class)
                                    @if($class_id == $class->id)
                                        <option selected>{{ $class->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >New Class</label>
                            <select name="new_class" class="form-control custom-select">
                                <option value="">Select</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Address</label>
                            <input type="text" value="{{ $student->address }}" name="address" class="form-control" placeholder="Enter Address">
                        </div>

                        <div class="form-group">
                            <label >City</label>
                            <input type="text" name="city" value="{{$student->city }}" class="form-control" placeholder="Enter City">
                        </div>

                        <div class="form-group">
                            <label >State</label>
                            <input type="text" value="{{$student->state }}" name="state" class="form-control" placeholder="Enter State">
                        </div>

                         <div class="form-group">
                            <label >PIN-CODE</label>
                            <input type="number" value="{{$student->pincode }}" name="pin_code" class="form-control" placeholder="Enter PIN-CODE" >
                        </div>

                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" value="{{$student->email }}" readonly autofocus placeholder="Enter Email">
                             @error('email')
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
                                @php
                                    $school_name = Cache::get('school_name_slug');
                                @endphp
                                @if(!empty($student->image))
                                    <img height="100" width="100" src='{{ asset("schools/$school_name/students/".$student->image) }}'>
                                @else
                                    NO IMAGE
                                @endif
                                <input type="hidden" name="current_image" value="{{ $student->image }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label >Password</label>
                            <input type="password" name="password" autocomplete="password" autofocus class="form-control
                             @error('password') is-invalid @enderror" placeholder="Enter Password" >
                              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                              @enderror
                        </div>
                        <div class="form-group">
                            <label >Aadhar Number</label>
                            <input type="alpha_num" name="id_proof" autocomplete="off"  required id="id_proof" maxlength="12"  autofocus class="form-control @error('id_proof') is-invalid @enderror" value="{{$student->id_proof }}" placeholder="Enter Aadhar Number">
                              @error('id_proof')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                        </div>
                        <div>
                            <label>Date Of Birth</label>
                            <input type="date" value="{{$student->DOB }}" required name="DOB" class="form-control">
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection