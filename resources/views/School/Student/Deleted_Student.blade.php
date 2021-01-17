@extends('layouts.master')
@section('title2','Student')
@section('title3','View Student')
@section('content')

    <div id="message_success" style="display: none;" class="alert alert-success">
        <p>STATUS UPDATED SUCCESSFULLY</p>
    </div>
	
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Teachers</h5>
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
                        	@php    
                                $id=1; 
                            @endphp
                        	@foreach($students as $student)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->id_proof }}</td>
                                <td>{{ $student->phone_no }}</td>
                                <td>
                                	<a class="btn btn-info" href="{{ route('student.deleted.restore',$student->id) }}">Restore</a>

                                    <a class="btn btn-danger" href="{{ route('student.permanent.deleted',$student->id) }}">Permanent Delete</a>

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