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
                    <form method="POST" action="{{ url('class/update/'.$class->id) }}">
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" required name="name" value="{{ $class->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                            @error('name')
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