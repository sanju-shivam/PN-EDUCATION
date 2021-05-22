@extends('layouts.master')
@section('title2','Time')
@section('title3','View Time')
@section('content')

  <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Time Chart</h5>
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th id="column3_search" scope="col">Start Time</th>
                                <th id="column3_search" scope="col">End Time</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $id=1; ?>
                            @foreach($times as $time)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $time->start_time }}</td>
                                <td>{{ $time->end_time }}</td>
                                <td class="text-center">
                                    <!-- <br> -->
                                    
                                    <a class="btn btn-warning" href="{{ url('time/edit/'.$time->id) }}" >Edit</a>
                                    
                                   <!--  <br> -->
                                        
                                    <a class="btn btn-danger" href="{{ url('time/delete/'.$time->id) }}">DELETE</a>                                  
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