@extends('layouts.master')
@section('title2','School')
@section('title3','Show School')
@section('content')
    <div id="message_success" style="display: none;" class="alert alert-success">
        <p>STATUS UPDATED SUCCESSFULLY</p>
    </div>

    <div id="wrapper">
      <div class="container-fluid p-2">
        <div class="row">
           <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
              <span>School Name :</span>
              <p class="text-uppercase title display-4 ">{{$school->name}}</p>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <span>School Logo :</span>
            @if(!empty($school->logo))
            
              <img src="{{url('/Schools/logo/'.$school->logo)}}" class="img-fluid img-responsive rounded-circle">
            @else
             NO IMAGE FOUND
            @endif
          </div> 
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="info">
             <span> Affilation No :</span> <p class="card-title">{{$school->affilation_no}}</p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>

        </div>
      </div>
    </div>
@endsection
 
