@extends('backend.layouts.app')

@section('title')
    Create
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
            <li class="breadcrumb-item active"><a href="{{route('admin.social-links.index')}}">Social Links</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="social" action="{{route('admin.social-links.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        
        <div class="card-body p-4">
            <div class="row justify-content-center">
                
               
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input id="name" type="text" name="name" placeholder="Enter social name"
                            class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Link</label>
                        <input id="link" type="text" name="link" placeholder="Enter social link"
                            class="form-control @error('link') is-invalid @enderror">

                        @error('link')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Icon</label>
                        <input id="icon" type="text" name="icon" placeholder="Enter font awesome icon"
                            class="form-control @error('icon') is-invalid @enderror">

                        @error('icon')
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
                    <button type="submit" class="btn btn-xs btn-primary">Save</button>
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
        $('#social').validate({
        rules: {
            name: {
                required: true,
            },
            link: {
                required: true,
            },
            icon: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "This field is required",
            },
            link: {
                required: "This field is required",
            },
            icon: {
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