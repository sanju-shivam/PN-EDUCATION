@extends('layouts.master')
@section('title2','Class')
@section('title3','Edit Class')
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Class</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ url('class/update/'.$class->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" required name="name" value="{{ $class->name }}" class="form-control" placeholder="Enter Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection