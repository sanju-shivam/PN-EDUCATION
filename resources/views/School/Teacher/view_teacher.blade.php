@extends('layouts.master')
@section('title2','Teacher')
@section('title3','View Teacher')
@section('content')

    <div id="message_success" style="display: none;" class="alert alert-success">
        <p>STATUS UPDATED SUCCESSFULLY</p>
    </div>
	
	<div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Teachers</h5>
                    <table class="table table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th id="column3_search" scope="col">Name</th>
                                <th scope="col">Profile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aadhar Number</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php  $id=1; ?>
                        	@foreach($teachers as $teacher)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $teacher->name }}</td>
                                <td>
                                    @if(!empty($teacher->image))
                                    <img height="100" width="100" src="{{ asset('schools/teachers/'.$teacher->image) }}">
                                    @else
                                    NO IMAGE
                                    @endif
                                </td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->id_proof }}</td>
                                <td>{{ $teacher->phone_no }}</td>
                                <td>
                                     <input type="checkbox" data-style="ios" class="status btn btn-success" rel="{{ $teacher->id }}"  data-toggle="toggle" name="status" @if($teacher->status == 0) checked @endif >
                                </td>
                                <td>
                                	<a class="btn btn-info" href="{{ route('teacher.show',$teacher->id) }}">View</a>
                                    
                                    <!-- <br> -->
                                	
                                    <a class="btn btn-warning" href="{{ url('teacher/edit/'.$teacher->id) }}" >Edit</a>
                                    
                                   <!--  <br> -->
                                        
                                    <a class="btn btn-danger" href="{{ url('teacher/deleted/'.$teacher->id) }}">DELETE</a>                                  
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

    // TO UPDATE STATUS OF TEACHER
    $(".status").change(function(){
            var id= $(this).attr('rel');
            var _token = $('input[name="_token"]').val();
            if($(this).prop('checked')==true){
              $.ajax({
              
                type: 'post',
                url:  '/UpdateTeacherStatus',
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
                    url:'/UpdateTeacherStatus',
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



 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready( function () {
                $('#dataTable').DataTable();
            });
        </script>

@endsection