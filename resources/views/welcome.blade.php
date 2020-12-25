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
        <title>PN-EDUCARES</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
        <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="../../assets/plugins/icomoon/style.css" rel="stylesheet">
        <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="../../assets/css/concept.min.css" rel="stylesheet">
        <link href="../../assets/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>        
        <div class="page-container">
                    <div class="login">
                        <div class="login-bg"></div>
                        <div class="login-content">
                            <div class="login-box">
                                <div class="login-header">
                                    <h3>Log In</h3>
                                    <p>Welcome back! Please login to continue.</p>
                                </div>
                                <div class="login-body">

                                    <form method="POST" action="{{ route('login') }}" >
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required aria-describedby="emailHelp" placeholder="Enter email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                        </div>

                                        <div class="custom-control custom-checkbox form-group">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                                            <label class="custom-control-label" for="remember">Remember password</label>

                                        </div>

                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </form>

                                    <p class="m-t-sm"><a href="#">Forgot password?</a><br><a href="{{ route('register') }}">Create an account</a></p>
                                </div>
                                <div class="login-footer">
                                    <p>Copyright @PN-INFOSYS</p>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

        <!-- Javascripts -->
        <script src="../../assets/plugins/jquery/jquery-3.1.0.min.js"></script>
        <script src="../../assets/plugins/bootstrap/popper.min.js"></script>
        <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../../assets/js/concept.min.js"></script>
    </body>
</html>