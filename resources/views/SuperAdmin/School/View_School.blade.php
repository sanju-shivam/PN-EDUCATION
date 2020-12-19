@extends('layouts.master')
@section('title2','School')
@section('title3','View School')
@section('content')
	
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Schools</h5>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th scope="col">Name</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Email</th>
                                <th scope="col">City</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php  $id=1; ?>
                        	@foreach($schools as $school)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->logo }}</td>
                                <td>{{ $school->email }}</td>
                                <td>{{ $school->city }}</td>
                                <td>{{ $school->phone_no }}</td>
                                <td>{{ $school->status }}</td>
                                <td>
                                	<a class="btn btn-info" href="{{ route('school.show',$school->id) }}">View</a>
                                    
                                    <br>
                                	
                                    <a class="btn btn-warning" href="{{ url('school/'.$school->id.'/edit') }}" >Edit</a>
                                    
                                    <br>
                                    
                                    <form method="post" action="{{ route('school.destroy',$school->id) }}">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
    </div>

@endsection