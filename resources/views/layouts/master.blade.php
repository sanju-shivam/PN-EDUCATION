<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>concept - Responsive Admin Dashboard Template</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/icomoon/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"> 

      
        <!-- Theme Styles -->
        <link href="{{asset('assets/css/concept.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css">

        <!-- Data Tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

        <style>
          .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px !important; }
          .toggle.ios .toggle-handle { border-radius: 20px !important; }
        </style>

        <script src="{{asset('assets/plugins/jquery/jquery-3.1.0.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
</head>
<body>

        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar">                
            </div><!-- /Page Sidebar -->
                
            
            <!-- Page Content -->
            <div class="page-content">
                @include('layouts.sidebar_and_menus')
                <!-- Page Header -->
                @include('layouts.header')
                <!-- /Page Header -->


                <!-- Page Inner -->
                <div class="page-inner no-page-title">
                    <div id="main-wrapper">
                        <div class="content-header">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-style-1">
                                    <li class="breadcrumb-item">Home</li>
                                    <!-- <li class="breadcrumb-item " aria-current="page"> -->@yield('title')</li>
                                    <li class="breadcrumb-item " aria-current="page">@yield('title2')</li>
                                    <li class="breadcrumb-item " aria-current="page">@yield('title3')</li>
                                </ol>
                            </nav>
                        </div>
                      
                
                      
                        <div class="row">
                            <div class="col-12">
                                @extends('layouts.toast')
                                @yield('content')
                            </div>
                        </div>
                    </div><!-- Main Wrapper -->

                    
                <div class="page-footer">
                    <p>2020 &copy; Shivam Shrivastava</p>
                </div>
                </div><!-- /Page Inner -->
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
        
        
        <!-- Javascripts -->
        
        <script src="{{asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/plugins/switchery/switchery.min.js')}}"></script>
        <script src="{{asset('assets/plugins/apexcharts/dist/apexcharts.min.js')}}"></script>
        <script src="{{asset('assets/js/concept.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
        <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="ab05fcab38e66c00fd31bbac-|49" defer=""></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js "></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready( function () {
            $('#dataTable').DataTable();
        } );
        </script>
</body>
</html>