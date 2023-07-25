<!DOCTYPE html>
<html lang="en" class="h-100">
<?php $setting = Setting();?>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login :: {{$setting->title}}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('backend/images/favicon.png')}}">
	<link href="{{url('backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{url('backend/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                @include('backend.layouts.alerts')
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="{{route('admin.login')}}">
                                            @if($setting->file_path_squre!='')
                                                <img src="{{ $setting->file_url }}" alt="{{ $setting->title }}">
                                            @else
                                                <img src="{{url('backend/images/logo-full.png')}}" alt="">
                                            @endif
                                        </a>
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form method="POST" action="@if(isset($_GET['next'])) {{route('user.login',['next'=>$_GET['next']])}} @else {{route('user.login')}} @endif">
                                    {{csrf_field()}}
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="form-check custom-checkbox ms-1">
													<input type="checkbox" class="form-check-input" id="remember" name="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
													<label class="form-check-label" for="remember">Keep me signed in</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{route('password.request')}}">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="{{route('signup.index')}}">Sign up</a></p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{url('backend/vendor/global/global.min.js')}}"></script>
	<script src="{{url('backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{url('backend/js/custom.min.js')}}"></script>
	<script src="{{url('backend/js/deznav-init.js')}}"></script>

</body>
</html>