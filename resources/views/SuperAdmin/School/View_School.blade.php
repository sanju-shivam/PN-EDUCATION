@extends('layouts.master')
@section('title2','School')
@section('title3','View School')
@section('content')

    <div id="message_success" style="display: none;" class="alert alert-success">
        <p>STATUS UPDATED SUCCESSFULLY</p>
    </div>
	
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Schools</h5>
                    <table class="table table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th scope="col">Name</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Email</th>
                                <th scope="col">City</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php  $id=1; ?>
                        	@foreach($schools as $school)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $school->name }}</td>
                                <td>
                                    @if(!empty($school->logo))
                                    <img height="100" width="100" src="{{ asset('schools/logo/'.$school->logo) }}">
                                    @else
                                    NO IMAGE
                                    @endif
                                </td>
                                <td>{{ $school->email }}</td>
                                <td>{{ $school->city }}</td>
                                <td>{{ $school->phone_no }}</td>
                                <td>
                                     <input type="checkbox" data-style="ios" class="status btn btn-success" rel="{{ $school->id }}"  data-toggle="toggle" name="status" @if($school->status == 1) checked @endif >
                                </td>
                                <td>
                                	<a class="btn btn-info" href="{{ route('school.show',$school->id) }}">View</a>
                                    
                                    <br>
                                	
                                    <a class="btn btn-warning" href="{{ url('school/'.$school->id.'/edit') }}" >Edit</a>
                                    
                                    <br>
                                    
                                    <form method="post" action="{{ route('school.destroy',$school->id) }}">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
    </div>







<script>
  $(document).ready(function() {

    //  STYLE OF STATUS BUTTON OF PRODUCT
    $('.status').bootstrapToggle({
      on: 'Visible',
      off: 'off',
      width : "80px",
      offstyle : 'danger',
      onstyle : 'success'
    });

    // TO UPDATE STATUS OF PRODUCT
    $(".status").change(function(){
            var id= $(this).attr('rel');
            var _token = $('input[name="_token"]').val();
            if($(this).prop('checked')==true){
              $.ajax({
              
                type: 'post',
                url:  '/SuperAdmin/UpdateSchoolStatus',
                data:{status:'1',id:id, _token:_token},
                success:function(data){
                    console.log(data);
                    $("#message_success").show();
                    setTimeout(function(){
                        $("#message_success").fadeOut('slow');
                    },2000);
                },
                error:function(){
                  alert("Error");
                }

              });
            }
            else{
                $.ajax({
                    type: 'post',
                    url:'/SuperAdmin/UpdateSchoolStatus',
                    data:{status:'0',id:id, _token:_token},
                    success:function(resp){
                        console.log(resp);
                        $("#message_success").show();
                        setTimeout(function(){
                            $("#message_success").fadeOut('slow');
                        },2000);
                    },
                    error:function(){
                        alert("Error");
                    }
                });
            }
    });


  });
</script>

@endsection