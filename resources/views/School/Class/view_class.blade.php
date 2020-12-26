@extends('layouts.master')
@section('title2','Class')
@section('title3','View Class')
@section('content')

    <div id="message_success" style="display: none;" class="alert alert-success">
        <p>STATUS UPDATED SUCCESSFULLY</p>
    </div>
    
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Class</h5>
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th id="column3_search" scope="col">Name</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $id=1; ?>
                            @foreach($classes as $class)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $class->name }}</td>
                                <td>
                                    <!-- <br> -->
                                    
                                    <a class="btn btn-warning" href="{{ url('class/edit/'.$class->id) }}" >Edit</a>
                                    
                                   <!--  <br> -->
                                        
                                    <a class="btn btn-danger" href="{{ url('class/delete/'.$class->id) }}">DELETE</a>                                  
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



 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready( function () {
                $('#dataTable').DataTable();
            });
        </script>

@endsection