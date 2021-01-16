@extends('layouts.master')
@section('title2','Relation')
@section('title3','Class Teacher Subject')
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
                    <h5 class="card-title">EDIT Assign Subject To Teacher ClassWise</h5>
                    <form method="POST" action="{{ url('class/teacher/update/'.$relation->id) }}">
                        @csrf
                        <div class="row">
                        	<div class="col-md-3 col-sm-3 col-xs-3">
		                        <div class="form-group">
		                            <label >Class</label>
		                            <select name="class_id" required class="form-control custom-select">
		                                <option value="">Select</option>
		                                @foreach($classes as $class)
		                                    <option @if($relation->class_id == $class->id) selected @endif value="{{ $class->id }}">{{ $class->name }}</option>
		                                @endforeach
		                            </select>
		                        </div>	
                        	</div>
                        	<div class="col-md-4 col-sm-4 col-xs-4">
		                        <div class="form-group">
		                            <label >Teacher</label>
		                            <select disabled required class="form-control custom-select">
		                                <option value="">Select</option>
		                                @foreach($teachers as $teacher)
		                                    <option @if($relation->teacher_id == $teacher->id) selected @endif value="{{ $teacher->id }}">{{ $teacher->name }}</option>
		                                @endforeach
		                            </select>
		                        </div>
                        	</div>
                        	<div class="col-md-2 col-sm-2 col-xs-2">
                        		<div class="form-group">
                        			<label>&nbsp;</label>
		                        	<button class="btn btn-success " style="height: 40px;position: relative;width: 100%;" type="Submit">Submit</button>
		                    	</div>
                        	</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection