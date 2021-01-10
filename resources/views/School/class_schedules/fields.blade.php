@extends('layouts.master')
@section('title2','Select Schedule Of Class')
@section('title3','Select Schedule Of Class')
@section('content')


  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
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
                    <form method="POST" action="{{ url('class_schedule') }}">
                        @csrf
                        <div class="row">
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
                            <label>Class</label>
                            <select  name="class_id" id="class_id" class="form-control @error('class') is-invalid @enderror">
                              <option value="">Select Class</option>
                              @foreach($classes as $class)
                              <option value="{{$class->id}}">{{$class->name}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group col-md-6 col-xs-12">
                            <label>Section</label>
                            <select  name="section"  class="form-control @error('section') is-invalid @enderror">
                              <option value="">Select Section</option>
                              @foreach($sections as $section)
                              <option value="{{$section->id}}">{{$section->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          
                          <div class="form-group col-md-6 col-xs-12">
                            <label>Teacher</label>
                            <select  name="teacher"  class="form-control @error('teacher') is-invalid @enderror">
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
                            <select  name="class"  class="form-control @error('day') is-invalid @enderror">
                              <option value="">Select Day</option>
                               @foreach($days as $day)
                              <option value="{{$day->id}}">{{$day->name}}</option>
                               @endforeach
                            </select>
                          </div>

                           <div class="form-group col-md-6 col-xs-12">
                            <label > Time</label>
                            <select  name="class"  class="form-control @error('start_time') is-invalid @enderror">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection