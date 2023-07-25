@extends('frontend.layouts.main')
@section('title', 'Create')
@section('css')

@endsection
@section('content')

<form id="fund" action="{{ route('user.funds.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
<div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div id="notify"> @include('frontend.layouts.alerts')</div>
                <div class="row justify-content-between">
                    <div class="d-flex align-items-end px-1">
                        <h1 class="d-inline-block mr-4"><small class="text-muted">Fund Transfer</small></h1>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.funds.index') }}" class="text-muted">Fund Transfer</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-2 text-right ">
                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Save"><i class="far fa-save"></i></button>
                        <a href="{{ route('user.funds.index') }}" class="btn btn-sm btn-outline-primary " title="Cancel"><i class="fas fa-reply"></i></a>
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
                                <h3 class="card-title"><i class="far fa-edit"></i>  Add Fund</h3>
                            </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Unique Code</label>
                                                <input type="text" name="unique_code" value="{{ old('unique_code') }}" class="form-control" placeholder="Unique code">
                                                @error('unique_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Amount</label>
                                                <input type="text" name="amount" value="{{ old('amount') }}" class="form-control" placeholder="Amount">
                                                @error('amount')
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
<script>
        $('#fund').validate({
        rules: {
            unique_code: {
                required: true,
            },
            amount: {
                required: true,
                number: true
            },
            remark: {
                required: true,
            },
        },
        messages: {
            unique_code: {
                required: "This field is required",
            },
            amount: {
                required: "This field is required",
            },
            remark: {
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
