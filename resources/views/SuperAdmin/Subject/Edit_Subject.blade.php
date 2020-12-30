@extends('layouts.master')
@section('title2','Subject')
@section('title3','Edit Subject')
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Subject</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ url('subject/update/'.$Subject->id) }}" >
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" required value="{{$Subject->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection