@extends('layouts.master')
@section('title2','Time Table')
@section('title3','Create and Update Time Table')
@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-md-10">
      <form method="Get" action="{{ url('create/timetable') }}">
          @csrf
          <table class="table table-responsive">
            <tr>
              <th class="col">
                <select name="class_id" required class="form-control custom-select" >
                  <option value="">Select a Class for Time-Table</option>
                  @foreach($classes as $classe)
                    <option @if($class_id == $classe->id) selected @endif value="{{ $classe->id }}">{{ $classe->name }}</option>
                  @endforeach
                </select>
              </th>
              <th class="col">
                <input type="submit" class="form-control btn btn-primary" style="color: white;" value="Submit">
              </th>
            </tr>
          </table>
            
      </form>
    </div>
  </div>
</div>

@if(!empty($class_id))
<head>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/cs.scss')}}">
</head>

<div class="card  col-md-8">
  <div class="card-body">        
    <table class="table table-bordered table-responsive">
      <thead>
        <tr>
          <!-- First column header is not rotated -->
          <th></th>
          <!-- Following headers are rotated -->
          @foreach($days as $day)
          <th class="rotate"><div><span>@php echo (strtoupper( $day->name)); @endphp</span></div></th>
            @endforeach
        </tr> 
      </thead>

      <?php $row_id =0;  ?>
      
      <tbody>
        @foreach($times as $time)
          <tr >
            <th class="row-header">{{ $time->start_time.' - '.$time->end_time }}</th>

              <td class="mx-auto">
                  <button type="button" class="mt-5 mx-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#MondayModal{{$row_id}}1">
                    <i class="fa fa-pen"></i>
                  </button>

                  
                  <div class="modal fade" id="MondayModal{{$row_id}}1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Monday Class</h5>
                          <button style="background-color: transparent;border: 0px;" data-bs-dismiss="modal" aria-label="Close">
                            <i style="font-size: 20px;" class="fa fa-times-circle"></i>
                          </button>
                        </div>
                        <form method="post" action="{{ url('store/timetable') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10" style="width: 80%;">
                                      <input type="hidden" name="row_id" value="{{ $row_id }}">
                                      <input type="hidden" name="class_id" value="{{ $class_id }}">
                                      <input type="hidden" name="day_id" value="1">
                                      <input type="hidden" name="time_slot_id" value="{{ $time->id }}">

                                      <select name="teacher" required class="form-control custom-select" >
                                          <option value="">Teacher</option>
                                          @foreach($Teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                          @endforeach
                                      </select>
                                      <br>
                                      <select name="subject" required class="form-control custom-select mt-2 mb-2">
                                          <option value="">Subject</option>
                                          @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-success" value="Update">
                                    </div> 
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </td>

              <td class="mx-auto">
                  <button type="button" class="mt-5 mx-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#TuesdayModal{{$row_id}}2">
                    <i class="fa fa-pen"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="TuesdayModal{{$row_id}}2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tuesday Class</h5>
                          <button style="background-color: transparent;border: 0px;" data-bs-dismiss="modal" aria-label="Close">
                            <i style="font-size: 20px;" class="fa fa-times-circle"></i>
                          </button>
                        </div>
                        <form method="post" action="{{ url('store/timetable') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10" style="width: 80%;">
                                      <input type="hidden" name="row_id" value="{{ $row_id }}">
                                      <input type="hidden" name="class_id" value="{{ $class_id }}">
                                      <input type="hidden" name="day_id" value="2">
                                      <input type="hidden" name="time_slot_id" value="{{ $time->id }}">

                                      <select name="teacher" required class="form-control custom-select" >
                                          <option value="">Teacher</option>
                                          @foreach($Teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                          @endforeach
                                      </select>
                                      <br>
                                      <select name="subject" required class="form-control custom-select mt-2 mb-2">
                                          <option value="">Subject</option>
                                          @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-success" value="Update">
                                    </div> 
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </td>

              <td class="mx-auto">
                  <button type="button" class="mt-5 mx-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#WednesdayModal{{$row_id}}2">
                    <i class="fa fa-pen"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="WednesdayModal{{$row_id}}2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Wednesday Class</h5>
                          <button style="background-color: transparent;border: 0px;" data-bs-dismiss="modal" aria-label="Close">
                            <i style="font-size: 20px;" class="fa fa-times-circle"></i>
                          </button>
                        </div>
                        <form method="post" action="{{ url('store/timetable') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10" style="width: 80%;">
                                      <input type="hidden" name="row_id" value="{{ $row_id }}">
                                      <input type="hidden" name="class_id" value="{{ $class_id }}">
                                      <input type="hidden" name="day_id" value="3">
                                      <input type="hidden" name="time_slot_id" value="{{ $time->id }}">

                                      <select name="teacher" required class="form-control custom-select" >
                                          <option value="">Teacher</option>
                                          @foreach($Teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                          @endforeach
                                      </select>
                                      <br>
                                      <select name="subject" required class="form-control custom-select mt-2 mb-2">
                                          <option value="">Subject</option>
                                          @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-success" value="Update">
                                    </div> 
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </td>

              <td class="mx-auto">
                  <button type="button" class="mt-5 mx-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#ThrushdayModal{{$row_id}}4">
                    <i class="fa fa-pen"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="ThrushdayModal{{$row_id}}4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Thrushday Class</h5>
                          <button style="background-color: transparent;border: 0px;" data-bs-dismiss="modal" aria-label="Close">
                            <i style="font-size: 20px;" class="fa fa-times-circle"></i>
                          </button>
                        </div>
                        <form method="post" action="{{ url('store/timetable') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10" style="width: 80%;">
                                      <input type="hidden" name="row_id" value="{{ $row_id }}">
                                      <input type="hidden" name="class_id" value="{{ $class_id }}">
                                      <input type="hidden" name="day_id" value="3">
                                      <input type="hidden" name="time_slot_id" value="{{ $time->id }}">

                                      <select name="teacher" required class="form-control custom-select" >
                                          <option value="">Teacher</option>
                                          @foreach($Teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                          @endforeach
                                      </select>
                                      <br>
                                      <select name="subject" required class="form-control custom-select mt-2 mb-2">
                                          <option value="">Subject</option>
                                          @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-success" value="Update">
                                    </div> 
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </td>

              <td class="mx-auto">
                  <button type="button" class="mt-5 mx-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#FridayModal{{$row_id}}5">
                    <i class="fa fa-pen"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="FridayModal{{$row_id}}5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Friday Class</h5>
                          <button style="background-color: transparent;border: 0px;" data-bs-dismiss="modal" aria-label="Close">
                            <i style="font-size: 20px;" class="fa fa-times-circle"></i>
                          </button>
                        </div>
                        <form method="post" action="{{ url('store/timetable') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10" style="width: 80%;">
                                      <input type="hidden" name="row_id" value="{{ $row_id }}">
                                      <input type="hidden" name="class_id" value="{{ $class_id }}">
                                      <input type="hidden" name="day_id" value="3">
                                      <input type="hidden" name="time_slot_id" value="{{ $time->id }}">

                                      <select name="teacher" required class="form-control custom-select" >
                                          <option value="">Teacher</option>
                                          @foreach($Teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                          @endforeach
                                      </select>
                                      <br>
                                      <select name="subject" required class="form-control custom-select mt-2 mb-2">
                                          <option value="">Subject</option>
                                          @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-success" value="Update">
                                    </div> 
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </td>

              <td class="mx-auto">
                  <button type="button" class="mt-5 mx-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#SaturdayModal{{$row_id}}6">
                    <i class="fa fa-pen"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="SaturdayModal{{$row_id}}6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Saturday Class</h5>
                          <button style="background-color: transparent;border: 0px;" data-bs-dismiss="modal" aria-label="Close">
                            <i style="font-size: 20px;" class="fa fa-times-circle"></i>
                          </button>
                        </div>
                        <form method="post" action="{{ url('store/timetable') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10" style="width: 80%;">
                                      <input type="hidden" name="row_id" value="{{ $row_id }}">
                                      <input type="hidden" name="class_id" value="{{ $class_id }}">
                                      <input type="hidden" name="day_id" value="3">
                                      <input type="hidden" name="time_slot_id" value="{{ $time->id }}">

                                      <select name="teacher" required class="form-control custom-select" >
                                          <option value="">Teacher</option>
                                          @foreach($Teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                          @endforeach
                                      </select>
                                      <br>
                                      <select name="subject" required class="form-control custom-select mt-2 mb-2">
                                          <option value="">Subject</option>
                                          @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-success" value="Update">
                                    </div> 
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </td>
          </tr>
          <?php $row_id++;  ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endif
<script href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/modernizr-2.7.1.js"></script>
@endsection