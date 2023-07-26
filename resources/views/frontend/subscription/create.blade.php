@extends('frontend.layouts.main')
@section('title', 'Create')
@section('css')

@endsection
@section('content')

<form id="subscription" action="{{ route('user.subscriptions.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
<div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div id="notify"> @include('frontend.layouts.alerts')</div>
                <div class="row justify-content-between">
                    <div class="d-flex align-items-end px-1">
                        <h1 class="d-inline-block mr-4"><small class="text-muted">Subscriptions</small></h1>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.subscriptions.index') }}" class="text-muted">Subscriptions</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-2 text-right ">
                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Save"><i class="far fa-save"></i></button>
                        <a href="{{ route('user.subscriptions.index') }}" class="btn btn-sm btn-outline-primary " title="Cancel"><i class="fas fa-reply"></i></a>
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
                                <h3 class="card-title"><i class="far fa-edit"></i>  Add Subscription</h3>
                            </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Plan Name</label>
                                                <select class="form-control select2 @error('plan_id') is-invalid @enderror" id="plan_id" name="plan_id">
                                                    <option value="">Please select plan</option>
                                                    @foreach($plans as $plan)
                                                        <option value="{{$plan->id}}">{{$plan->plan_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('plan_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Amount</label>
                                                <input type="text" id="amount" name="amount" value="{{ old('amount') }}" class="form-control" placeholder="Amount" disabled>
                                                @error('amount')
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
<script src="{{ url('frontend/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
        $('#subscription').validate({
        rules: {
            plan_id: {
                required: true,
            },
        },
        messages: {
            plan_id: {
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
    $(document).on('change', '#plan_id', function () {
        var plan_id = this.value;
        $.ajax({
            url: "{{route('fetchPlanAmount')}}",
            type: "POST",
            data: {
                plan_id: plan_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                console.log(result);
                $('#amount').val(result);
            }
        });
    });
    </script>
@endsection
