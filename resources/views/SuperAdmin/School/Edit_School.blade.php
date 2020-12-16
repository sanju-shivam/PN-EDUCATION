@extends('layouts.master')
@section('content')
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add School</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="post" action="{{url('update_school')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$get->id}}">
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" value="{{$get->name}}" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                        	<label >Logo</label>
                        	<div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input form-control" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img src="{{'/uploads/schools/logo'.$get->logo}}" height="100px" width="100px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Address</label>
                            <input type="text" name="address" value="{{$get->address}}" class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label >City</label>
                            <input type="text" name="city" value="{{$get->city}}" class="form-control" placeholder="Enter City">
                        </div>
                        <div class="form-group">
                            <label >State</label>
                            <input type="text" name="state" value="{{$get->state}}" class="form-control" placeholder="Enter State">
                        </div>
                        <div class="form-group">
                            <label >PIN-CODE</label>
                            <input type="number" name="pin_code" value="{{$get->pin_code}}" class="form-control" placeholder="Enter PIN-CODE" >
                        </div>
                        <div class="form-group">
                            <label >Phone Number</label>
                            <input type="number"   name="phone_no" value="{{$get->phone_no}}" class="form-control" placeholder="Enter Phone Number" >
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" name="email" value="{{$get->email}}" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label >Affilation Number</label>
                            <input type="alpha_num" name="affilation_no" value="{{$get->affilation_no}}" class="form-control" placeholder="Enter Affilation Number">
                        </div>
                        <div class="form-group">
                            <label >Board</label>
                            <input type="text" name="board_name" value="{{$get->board_name}}" class="form-control" placeholder="Enter Affilation Board">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection