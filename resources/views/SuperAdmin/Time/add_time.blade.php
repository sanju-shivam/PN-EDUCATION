@extends('layouts.master')
@section('title2','Time')
@section('title3','Add Time')
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Time</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ route('time.store') }}">
                        @csrf
                        <div class="form-group">
                            <label >Time</label>
                            <input type="text" name="time" required class="form-control @error('time') is-invalid @enderror" placeholder="Enter time">
                           
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection