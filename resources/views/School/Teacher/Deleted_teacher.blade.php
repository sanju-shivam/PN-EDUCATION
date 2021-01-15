@extends('layouts.master')
@section('title2','Teacher')
@section('title3','Deleted Teacher')
@section('content')
	
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Deleted Teachers</h5>
                    <table class="table table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th id="column3_search" scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aadhar Number</th>
                                <th scope="col">Phone No</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@php    $id=1; 
                                    $school_cache   =   Str::slug(Cache::get('school')->name);
                            @endphp
                        	@foreach($teachers as $teacher)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->id_proof }}</td>
                                <td>{{ $teacher->phone_no }}</td>
                                <td>
                                	<a class="btn btn-success" href="{{ route('teacher.deleted.restore',$teacher->id) }}">Restore</a>
                                    
                                        
                                    <a class="btn btn-danger" href="{{ url('deleted/permanent/teacher/'.$teacher->id) }}">Permanent Delete</a>                                  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
    </div>







 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready( function () {
                $('#dataTable').DataTable();
            });
        </script>

@endsection