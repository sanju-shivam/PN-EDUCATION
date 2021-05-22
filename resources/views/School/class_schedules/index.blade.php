@extends('layouts.master')
@section('title2','Class schedule ')
@section('title3','View Class Schedule')
@section('content')

  <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h1 class="pull-right">
                    
                      <a class="btn btn-success pull-right float-right" data-target=".bd-example-modal-lg" data-toggle="modal" href="{{route('class_schedule')}}">ADD NEW SCHEDULE</a>
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
                            @foreach($class_schedules as $class_schedule)
                            <tr class="text-center">
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $class_schedule->subject[0]->name}}</td>
                                <td>{{$class_schedule->class[0]->name}}</td>
                                <td>{{$class_schedule->section[0]->name}}</td>
                                <td>{{$class_schedule->teacher[0]->name}}</td>
                                <td>{{$class_schedule->day[0]->name}}</td>
                                <td>{{$class_schedule->time[0]->time}}</td>

                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{ url('day/edit/'.$class_schedule->id) }}" >Edit</a>
                                        
                                    <a class="btn btn-danger" href="{{ url('day/delete/'.$class_schedule->id) }}">DELETE</a>                                  
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