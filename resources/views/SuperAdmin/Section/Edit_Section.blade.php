@extends('layouts.master')
@section('title2','Section')
@section('title3','Edit Section')
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Section</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ url('section/update/'.$section->id) }}">
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" required name="name" value="{{ $section->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                            
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection