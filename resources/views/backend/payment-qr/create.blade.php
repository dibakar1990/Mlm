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
            <li class="breadcrumb-item active"><a href="{{route('admin.payment-qr.index')}}">Payment QR</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="payment_qr" action="{{route('admin.payment-qr.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        
        <div class="card-body p-4">
            <div class="row justify-content-center">
               
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Currency Name</label>
                        <input id="currency_name" type="text" name="currency_name" placeholder="Enter Currency name"
                            class="form-control @error('currency_name') is-invalid @enderror">

                        @error('currency_name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Network</label>
                        <input id="network" type="text" name="network" placeholder="Enter network"
                            class="form-control @error('network') is-invalid @enderror">

                        @error('network')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input id="address" type="text" name="address" placeholder="Enter address"
                            class="form-control @error('address') is-invalid @enderror">

                        @error('address')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <div class="form-file">
                            <input type="file" id="file" name="file" class="form-file-input form-control @error('file') is-invalid @enderror" accept='.jpg, .jpeg, .png'>
                        </div>

                        @error('file')
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
        $('#payment_qr').validate({
        rules: {
            currency_name: {
                required: true,
            },
            network: {
                required: true,
            },
            address: {
                required: true,
            },
            file: {
                required: true,
            },
        },
        messages: {
            currency_name: {
                required: "This field is required",
            },
            network: {
                required: "This field is required",
            },
            address: {
                required: "This field is required",
            },
            file: {
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