@extends('layouts.master')
@section('title2','Day')
@section('title3','Add Day')
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
                    <h5 class="card-title">Add Day</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ url('day/store') }}">
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" required class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
                           
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection