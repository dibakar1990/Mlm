<!DOCTYPE html>
<html lang="en" class="h-100">
<?php $setting = Setting();?>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Signup :: {{$setting->title}} </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('backend/images/favicon.png')}}">
    <link rel="stylesheet" href="{{url('backend/vendor/select2/css/select2.min.css')}}">
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
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form method="POST" id="signup" action="{{route('signup.store')}}">
                                    {{csrf_field()}}
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Referal Code</strong></label>
                                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder=" Referal Code" value="{{old('code',$code)}}">
                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Name</strong></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{old('name')}}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
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
                                            <label class="mb-1"><strong>Mobile Number</strong></label>
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" value="{{old('phone')}}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Country</strong></label>
                                            <select name="country_id" id="country_id" class="single-select form-control wide mb-3 @error('country_id') is-invalid @enderror">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                                
                                            </select>
                                            @error('country_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>State</strong></label>
                                            
                                            <select name="state_id" id="state-dropdown" class="single-select form-control wide mb-3 @error('state_id') is-invalid @enderror">
                                                <option value="">Select Country first</option>                                                
                                            </select>
                                            @error('state_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>City</strong></label>
                                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="City" value="{{old('city')}}">
                                            @error('city')
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
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder=" Confirm password">
                                            @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="{{route('user.login')}}">Sign in</a></p>
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
    <script src="{{url('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('backend/js/plugins-init/select2-init.js')}}"></script>
    <script src="{{url('backend/js/custom.min.js')}}"></script>
	<script src="{{url('backend/js/deznav-init.js')}}"></script>
    <script>
        $('.single-select').select2();
        $(document).on('change', '#country_id', function () {

            var idCountry = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                    url: "{{route('fetchState')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
        });
    </script>
</body>
</html>