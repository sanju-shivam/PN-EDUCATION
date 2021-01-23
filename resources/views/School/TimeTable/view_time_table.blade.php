@extends('layouts.master')
@section('title2','Time Table')
@section('title3','Create and Update Time Table')
@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-md-10">
      <form method="Get" action="{{ url('view/timetable') }}">
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
          @foreach($time_tables as $time_table)
            @if($time->id == $time_table->time_slot_id and $time_table->day_id == 1 and $time_table->row_id == 0)
            <td>
                <div class="row">
                    <div class="col-md-10" style="width: 80%;">
                          {{ $time_table->Teacher[0]->name }}
                    </div>
                </div>
            </td>
            @endif
            @if($time->id == $time_table->time_slot_id and $time_table->day_id == 2 and $time_table->row_id == 0)
            <td>
                <div class="row">
                    <div class="col-md-10" style="width: 80%;">
                          {{ $time_table->Teacher[0]->name }}
                    </div>
                </div>
            </td>
            @endif
          @endforeach
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