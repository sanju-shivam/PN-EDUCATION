@extends('layouts.master')
@section('title2','Time Table')
@section('title3','Create and Update Time Table')
@section('content')


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
                <input type="submit" class="form-control btn btn-primary" style="color: white;" value="Get TimeTable">
              </th>
            </tr>
          </table>
            
      </form>
    </div>
  </div>

@if(!empty($class_id))
<head>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/cs.scss')}}">
</head>

<div class="row col-md-12">
    <div class="card">
      <div class="card-body col-md-12">        
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

          <?php $row_id =0;?>
          <tbody>
            @foreach($times as $time)
            <tr>
                <th>
                  {{ $time->start_time.'-'.$time->end_time }}
                </th>

                <?php
                      $day1 = $time_tables
                              ->where('time_slot_id',$time->id)
                              ->where('day_id',1)->first();
                ?>
                @if(!empty($day1))
                  <td>
                    {{ $day1->Teacher[0]->name }} <br>
                    {{ $day1->Subject[0]->name }}
                  </td>
                @else
                  <td>-</td>
                @endif


                <?php  
                    $day2 = $time_tables
                            ->where('time_slot_id',$time->id)
                            ->where('day_id',2)->first();
                ?>
                @if(!empty($day2))
                  <td>
                    {{ $day2->Teacher[0]->name }}<br>
                    {{ $day2->Subject[0]->name }}
                  </td>
                @else
                  <td>-</td>
                @endif


                <?php
                    $day3 = $time_tables
                            ->where('time_slot_id',$time->id)
                            ->where('day_id',3)->first();
                ?>
                @if(!empty($day3))
                  <td>
                    {{ $day3->Teacher[0]->name }}<br>
                    {{ $day3->Subject[0]->name }}
                  </td>
                @else
                  <td>-</td>
                @endif



                <?php  
                    $day4 = $time_tables
                            ->where('time_slot_id',$time->id)
                            ->where('day_id',4)->first();
                ?>
                @if(!empty($day4))
                  <td>
                    {{ $day4->Teacher[0]->name }}<br>
                    {{ $day4->Subject[0]->name }}
                  </td>
                @else
                  <td>-</td>
                @endif


                <?php  
                    $day5 = $time_tables
                            ->where('time_slot_id',$time->id)
                            ->where('day_id',5)->first();
                ?>
                @if(!empty($day5))
                  <td>
                    {{ $day5->Teacher[0]->name }}<br>
                    {{ $day5->Subject[0]->name }}
                  </td>
                @else
                  <td>-</td>
                @endif




                <?php  
                    $day6 = $time_tables
                            ->where('time_slot_id',$time->id)
                            ->where('day_id',6)->first();
                ?>
                @if(!empty($day6))
                  <td>
                    {{ $day6->Teacher[0]->name }}<br>
                    {{ $day6->Subject[0]->name }}
                  </td>
                @else
                  <td>-</td>
                @endif



            </tr>
            <?php $row_id++;?>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>

@endif
<script href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/modernizr-2.7.1.js"></script>
@endsection