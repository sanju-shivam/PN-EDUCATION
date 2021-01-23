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

<div class="card">
  <div class="card-body">        
    <table class="table table-responsive">
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

              <td>
                <form method="post" action="{{ url('store/timetable') }}">
                  @csrf
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
                     <!--  </div>
                      <div class="col-md-6"> -->
                        <select name="subject" required class="form-control custom-select mt-2 mb-2">
                            <option value="">Subject</option>
                            @foreach($subjects as $subject)
                              <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>

                      <input type="submit" class="btn btn-success" value="Update">
                      </div>  
                  </div>
                </form>
              </td>

              <td>
                <form method="post" action="{{ url('store/timetable') }}">
                  @csrf
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
                     <!--  </div>
                      <div class="col-md-6"> -->
                        <select name="subject" required class="form-control custom-select mt-2 mb-2">
                            <option value="">Subject</option>
                            @foreach($subjects as $subject)
                              <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>

                      <input type="submit" class="btn btn-success" value="Update">
                      </div>  
                  </div>
                </form>
              </td>

              <td>
                <form method="post" action="{{ url('store/timetable') }}">
                  @csrf
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
                     <!--  </div>
                      <div class="col-md-6"> -->
                        <select name="subject" required class="form-control custom-select mt-2 mb-2">
                            <option value="">Subject</option>
                            @foreach($subjects as $subject)
                              <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>

                      <input type="submit" class="btn btn-success" value="Update">
                      </div>  
                  </div>
                </form>
              </td>

              <td>
                <form method="post" action="{{ url('store/timetable') }}">
                  @csrf
                  <div class="row">
                      <div class="col-md-10" style="width: 80%;">
                        <input type="hidden" name="row_id" value="{{ $row_id }}">
                        <input type="hidden" name="class_id" value="{{ $class_id }}">
                        <input type="hidden" name="day_id" value="4">
                        <input type="hidden" name="time_slot_id" value="{{ $time->id }}">


                        <select name="teacher" required class="form-control custom-select" >
                            <option value="">Teacher</option>
                            @foreach($Teachers as $teacher)
                              <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <br>
                     <!--  </div>
                      <div class="col-md-6"> -->
                        <select name="subject" required class="form-control custom-select mt-2 mb-2">
                            <option value="">Subject</option>
                            @foreach($subjects as $subject)
                              <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>

                      <input type="submit" class="btn btn-success" value="Update">
                      </div>  
                  </div>
                </form>
              </td>

              <td>
                <form method="post" action="{{ url('store/timetable') }}">
                  @csrf
                  <div class="row">
                      <div class="col-md-10" style="width: 80%;">
                        <input type="hidden" name="row_id" value="{{ $row_id }}">
                        <input type="hidden" name="class_id" value="{{ $class_id }}">
                        <input type="hidden" name="day_id" value="5">
                        <input type="hidden" name="time_slot_id" value="{{ $time->id }}">


                        <select name="teacher" required class="form-control custom-select" >
                            <option value="">Teacher</option>
                            @foreach($Teachers as $teacher)
                              <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <br>
                     <!--  </div>
                      <div class="col-md-6"> -->
                        <select name="subject" required class="form-control custom-select mt-2 mb-2">
                            <option value="">Subject</option>
                            @foreach($subjects as $subject)
                              <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>

                      <input type="submit" class="btn btn-success" value="Update">
                      </div>  
                  </div>
                </form>
              </td>


              <td>
                <form method="post" action="{{ url('store/timetable') }}">
                  @csrf
                  <div class="row">
                      <div class="col-md-10" style="width: 80%;">
                         <input type="hidden" name="row_id" value="{{ $row_id }}">
                        <input type="hidden" name="class_id" value="{{ $class_id }}">
                        <input type="hidden" name="day_id" value="6">
                        <input type="hidden" name="time_slot_id" value="{{ $time->id }}">


                        <select name="teacher" required class="form-control custom-select" >
                            <option value="">Teacher</option>
                            @foreach($Teachers as $teacher)
                              <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <br>
                     <!--  </div>
                      <div class="col-md-6"> -->
                        <select name="subject" required class="form-control custom-select mt-2 mb-2">
                            <option value="">Subject</option>
                            @foreach($subjects as $subject)
                              <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>

                      <input type="submit" class="btn btn-success" value="Update">
                      </div>  
                  </div>
                </form>
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