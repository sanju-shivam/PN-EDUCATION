@extends('layouts.master')
@section('title2','Class schedule ')
@section('title3','View Class Schedule')
@section('content')

  <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h1 class="pull-right">
                    
                      <a class="btn btn-success pull-right float-right" data-target=".bd-example-modal-lg" data-toggle="modal" >ADD NEW SCHEDULE</a>
                    </h1>
                    <h5 class="card-title">All Class</h5>

                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th id="column3_search" scope="col">Subject</th>
                                <th id="column3_search" scope="col">Class Name</th>
                                <th id="column3_search" scope="col">Section Name</th>
                                <th id="column3_search" scope="col">Teacher Name</th>
                                <th id="column3_search" scope="col">Day </th>
                                <th id="column3_search" scope="col"> Time</th>
                                <!-- <t h id="column3_search" scope="col">End Time</th> -->
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $id=1; ?>
                            @foreach($schedules as $day)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $day->name }}</td>
                                <td class="text-center">
                                    <!-- <br>
                                    
                                    <a class="btn btn-warning" href="{{ url('day/edit/'.$day->id) }}" >Edit</a>
                                    
                                   <!--  <br> -->
                                        
                                    <a class="btn btn-danger" href="{{ url('day/delete/'.$day->id) }}">DELETE</a>                                  
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