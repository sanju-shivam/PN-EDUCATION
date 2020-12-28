@extends('layouts.master')
@section('title2','Subject')
@section('title3','View Subject')
@section('content')

    <div id="message_success" style="display: none;" class="alert alert-success">
        <p>STATUS UPDATED SUCCESSFULLY</p>
    </div>
	
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Subjects</h5>
                    <table class="table table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th id="column3_search" scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php  $id=1; ?>
                        	@foreach($Subject as $subject)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $subject->name }}</td>
                                
                                <td>
                                	<a class="btn btn-info" href="{{ route('school.show',$subject->id) }}">View</a>
                                    
                                    <!-- <br> -->
                                	
                                    <a class="btn btn-warning" href="{{ url('school/'.$subject->id.'/edit') }}" >Edit</a>
                                    
                                   <!--  <br> -->
                                        
                                    <a class="btn btn-danger" href="{{ url('school/delete/'.$subject->id) }}">DELETE</a>
                                    
                                    
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