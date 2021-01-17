@extends('layouts.master')
@section('title2','Select Schedule Of Class')
@section('title3','Select Schedule Of Class')
@section('content')

    <div class="row">
      <div class="col-xl"> 
        @if($errors->any())
           <div>
              <ul>
                 @foreach($errors->all() as $error)
                 <li class="alert alert-danger alert-dismissable list-unstyled">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                    {{$error}}
                 </li>
                 @endforeach
             </ul>
          </div>    
        @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Select Schedule Of Class</h5>
                    <!-- <p>Here’s a quick example to demonstrate Bootstrap’s form styles. </p> -->
                    <form method="POST" action="{{ url('class_schedule/store') }}">
                        @csrf
                        <input type="hidden" name="institute_id" value="{{Auth::user()->user_type_id}}">
                        <div class="row">
                         
                          <div class="form-group col-md-6 col-xs-12">
                            <label>Class</label>
                            <select  name="class_id" id="class_id" class="form-control @error('class_id') is-invalid @enderror">
                              <option value="">Select Class</option>
                              @foreach($classes as $class)
                              <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          
                          <div class="form-group col-md-6 col-xs-12">
                            <label>Subject</label>
                            <select  name="subject_id" id="subject_id"  class="form-control @error('subject_id') is-invalid @enderror">
                              <option value="">Select Subject</option>
                              @foreach($subjects as $subject)
                              <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group col-md-6 col-xs-12">
                            <label>Section</label>
                            <select  name="section_id"  class="form-control @error('section_id') is-invalid @enderror">
                              <option value="">Select Section</option>
                              @foreach($sections as $section)
                              <option value="{{$section->id}}">{{$section->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          
                          <div class="form-group col-md-6 col-xs-12">
                            <label>Teacher</label>
                            <select  name="teacher_id"  class="form-control @error('teacher_id') is-invalid @enderror">
                              <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                              <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        

                        <div class="row">
                          <div class="form-group col-md-6 col-xs-12">
                            <label >Day</label>
                            <select  name="day_id"  class="form-control @error('day_id') is-invalid @enderror">
                              <option value="">Select Day</option>
                               @foreach($days as $day)
                              <option value="{{$day->id}}">{{$day->name}}</option>
                               @endforeach
                            </select>
                          </div>

                           <div class="form-group col-md-6 col-xs-12">
                            <label > Time</label>
                            <select  name="time_id"  class="form-control @error('time_id') is-invalid @enderror">
                              <option value="">Select Time</option>
                              @foreach($times as $time)
                              <option value="{{$time->id}}">{{$time->time}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
     </div>
    </div>
    
@endsection