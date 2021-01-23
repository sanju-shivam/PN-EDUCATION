@extends('layouts.master')
@section('title2','Teacher')
@section('title3','Add Teacher')
@section('content')
	<div class="conatiner ">
		<div class="row">
			<div class="col-md-4 mb-3">
				<a style="width: 70%;" href="{{ url('teacher/bulk/export') }}" class=" btn btn-success">EXPORT</a>
			</div>
			<div class="col-md-4 mb-3">
				<a style="width: 70%;" href="{{ url('teacher/bulk/export/sample') }}" class=" btn btn-info">EXPORT SAMPLE SHEET</a>
			</div>
		</div>
	</div>
	<div class="card">

        <div class="card-body">
            <h5 class="card-title">Import Teacher</h5>
            <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
            <form method="POST" action="{{ url('teacher/bulk/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label >Import Excle File</label>
                    <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input form-control" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection