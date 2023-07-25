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
            <li class="breadcrumb-item active"><a href="{{route('admin.bonus.index')}}">Bonus</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="bonus" action="{{route('admin.bonus.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        
        <div class="card-body p-4">
            <div class="row justify-content-center">
               
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Level Name</label>
                        <select name="level_id" id="level_id" class="js-example-theme-single form-control wide mb-3 @error('level_id') is-invalid @enderror">
                            <option value="">Select Level Name</option>
                            @foreach($items as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                            
                        </select>
                        @error('level_id')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Plan Name</label>
                        <select name="plan_id" id="plan_id" class="js-example-theme-single form-control wide mb-3 @error('plan_id') is-invalid @enderror">
                            <option value="">Select Plan Name</option>
                            @foreach($plans as $plan)
                            <option value="{{$plan->id}}">{{$plan->plan_name}}</option>
                            @endforeach
                            
                        </select>
                        @error('plan_id')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input id="amount" type="text" name="amount" placeholder="Enter amount"
                            class="form-control @error('amount') is-invalid @enderror">

                        @error('amount')
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
    <script src="{{url('backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{url('backend/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('backend/js/plugins-init/select2-init.js')}}"></script>
    <script>
        $("#level_id").select2();
        $("#plan_id").select2();
        $('#bonus').validate({
        rules: {
            level_id: {
                required: true,
            },
            plan_id: {
                required: true,
            },
            amount: {
                required: true,
                number: true,
            },
        },
        messages: {
            level_id: {
                required: "This field is required",
            },
            plan_id: {
                required: "This field is required",
            },
            amount: {
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