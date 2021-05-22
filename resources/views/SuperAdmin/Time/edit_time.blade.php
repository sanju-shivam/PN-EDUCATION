@extends('layouts.master')
@section('title2','Time')
@section('title3','Edit Time')
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Time</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ route('time.update',$time->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Start Time</label>
                                    <input type="time" required name="start_time" class="form-control" value="{{ $time->start_time }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >End Time</label>
                                    <input type="time" required name="end_time" class="form-control" value="{{ $time->end_time }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >&nbsp;</label>
                                    <input type="submit" class="form-control btn btn-primary" style="color: white;" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
    </div>
@endsection