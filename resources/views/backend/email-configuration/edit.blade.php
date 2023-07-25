@extends('backend.layouts.app')

@section('title')
    Email Configuration
@endsection

@section('styles')
    @parent

    @stack('styles')
@endsection

@section('content')
	<div class="content-body">
        <div class="container-fluid">
        <div id="notify">@include('backend.layouts.alerts')</div>
        <div class="row ">
    <div class="col-sm-6 d-flex align-items-center">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.email-configurations.edit',['email_configuration' => $emailConfiguration->id])}}">Email Configuration</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="setting" action="{{route('admin.email-configurations.update',['email_configuration' => $emailConfiguration->id])}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mail Driver</label>
                        <input id="driver" type="text" name="driver" value="{{ $emailConfiguration->driver }}"
                            class="form-control @error('driver') is-invalid @enderror">

                        @error('driver')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mail Host</label>
                        <input id="host" type="text" name="host" value="{{ $emailConfiguration->host }}"
                            class="form-control @error('host') is-invalid @enderror">

                        @error('host')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mail Port</label>
                        <input id="port" type="text" name="port" value="{{ $emailConfiguration->port }}"
                            class="form-control @error('port') is-invalid @enderror">

                        @error('port')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mail Username</label>
                        <input id="username" type="email" name="username" value="{{ $emailConfiguration->user_name }}"
                            class="form-control @error('username') is-invalid @enderror">

                        @error('username')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mail Password</label>
                        <input id="password" type="text" name="password" value="{{ $emailConfiguration->password }}"
                            class="form-control @error('password') is-invalid @enderror">

                        @error('password')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mail Encryption</label>
                        
                        <select name="encryption" id="encryption" class="default-select form-control wide mb-3 @error('encryption') is-invalid @enderror">
                            <option value="">Select encryption</option>
                            <option value="ssl" @if($emailConfiguration->encryption == 'ssl'){{'selected'}}@endif>SSl</option>
                            <option value="tls" @if($emailConfiguration->encryption == 'tls'){{'selected'}}@endif>TLS</option>
                        </select>
                        @error('encryption')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">From Address</label>
                        <input id="from_address" type="email" name="from_address" value="{{ $emailConfiguration->from_address }}"
                            class="form-control @error('from_address') is-invalid @enderror">

                        @error('from_address')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">From Name</label>
                        <input id="from_name" type="text" name="from_name" value="{{ $emailConfiguration->from_name }}"
                            class="form-control @error('from_name') is-invalid @enderror">

                        @error('from_name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                
            </div><!-- /.row -->

            <div class="row">
                <div class="col-sm-6 d-flex align-items-center"></div>
                <div class="col-sm-6 d-flex flex-row-reverse align-items-center">
                    <button type="submit" class="btn btn-xs btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
    @parent
    <script src="{{url('backend/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script>
        $('#setting').validate({
        rules: {
            driver: {
                required: true,
            },
            host: {
                required: true,
            },
            port: {
                required: true,
            },
            username: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
            encryption: {
                required: true,
            },
            from_address: {
                required: true,
                email: true,
            },
        },
        messages: {
            driver: {
                required: "This field is required",
            },
            host: {
                required: "This field is required",
            },
            port: {
                required: "This field is required",
            },
            username: {
                required: "This field is required",
            },
            encryption: {
                required: "This field is required",
            },
            from_address: {
                required: "This field is required",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        }
    });
    </script>
    @stack('scripts')
@endsection