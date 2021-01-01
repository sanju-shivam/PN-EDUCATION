@extends('layouts.master')
@section('title2','School')
@section('title3','Deleted School')
@section('content')
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Schools</h5>
                    <table class="table table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th id="column3_search" scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">City</th>
                                <th scope="col">Phone No</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php  $id=1; ?>
                        	@foreach($schools as $school)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->email }}</td>
                                <td>{{ $school->city }}</td>
                                <td>{{ $school->phone_no }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('deleted/restore/school/'.$school->id) }}" >Restore</a>
                                    
                                   <!--  <br> -->
                                        
                                    <a class="btn btn-danger" href="{{ url('deleted/permanent/school/'.$school->id) }}">Permanent Delete</a>      
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