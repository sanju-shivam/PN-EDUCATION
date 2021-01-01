@extends('layouts.master')
@section('title2','Section')
@section('title3','View Section')
@section('content')

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
                            @foreach($sections as $section)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $section->name }}</td>
                                <td class="text-center">
                                    <!-- <br> -->
                                    
                                    <a class="btn btn-warning" href="{{ url('section/edit/'.$section->id) }}" >Edit</a>
                                    
                                   <!--  <br> -->
                                        
                                    <a class="btn btn-danger" href="{{ url('section/delete/'.$section->id) }}">DELETE</a>                                  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
    </div>




 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready( function () {
                $('#dataTable').DataTable();
            });
        </script>

@endsection