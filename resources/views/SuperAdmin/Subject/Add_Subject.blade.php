@extends('layouts.master')
@section('title2','Subject')
@section('title3','Add Subject')
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Subject</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ url('subject/store') }}" >
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection