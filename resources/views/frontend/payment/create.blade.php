@extends('frontend.layouts.main')
@section('title', 'Create')
@section('css')

@endsection
@section('content')

<form id="payment_request" action="{{ route('user.payment.request.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
<div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div id="notify"> @include('frontend.layouts.alerts')</div>
                <div class="row justify-content-between">
                    <div class="d-flex align-items-end px-1">
                        <h1 class="d-inline-block mr-4"><small class="text-muted">Payment Request</small></h1>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.payment.pending.request.index') }}" class="text-muted">Payment Request</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-2 text-right ">
                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Save"><i class="far fa-save"></i></button>
                        <a href="{{ route('user.payment.pending.request.index') }}" class="btn btn-sm btn-outline-primary " title="Cancel"><i class="fas fa-reply"></i></a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="far fa-edit"></i>  Payment Request</h3>
                            </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Request Amount</label>
                                                <input type="text" name="request_amount" value="{{ old('request_amount') }}" class="form-control" placeholder="Enter request amount">
                                                @error('request_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Transaction ID</label>
                                                <input type="text" name="transaction_id" value="{{ old('transaction_id') }}" class="form-control" placeholder="Enter transaction id">
                                                @error('transaction_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Remark</label>
                                                <input type="text" name="remark" value="{{ old('remark') }}" class="form-control" placeholder="Remark">
                                                @error('remark')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Payment Screenshot</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input" id="exampleInputFile"  accept='.jpg, .jpeg, .png'>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    </div>
                                                </div>
                                                @error('remark')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</form>

@endsection
@section('js')
<script src="{{ url('frontend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{url('frontend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
    
        bsCustomFileInput.init();
    });
        $('#payment_request').validate({
        rules: {
            request_amount: {
                required: true,
                number: true
            },
            transaction_id: {
                required: true,
            },
            file: {
                required: true,
            },
        },
        messages: {
            request_amount: {
                required: "This field is required",
            },
            transaction_id: {
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
@endsection
