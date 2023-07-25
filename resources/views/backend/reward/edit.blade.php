@extends('backend.layouts.app')

@section('title')
    Edit
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
            <li class="breadcrumb-item active"><a href="{{route('admin.rewards.edit',['reward' => $data->id])}}">Rank and Rewards</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="rank_rewards" action="{{route('admin.rewards.update',['reward' => $data->id])}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            <div class="row justify-content-center">
               
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Rank Name</label>
                        <input id="rank_name" type="text" name="rank_name" value="{{$data->rank_name}}" placeholder="Enter rank name"
                            class="form-control @error('rank_name') is-invalid @enderror">

                        @error('rank_name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">A Team</label>
                        <input id="a_team" type="text" name="a_team" value="{{$data->a_team}}" placeholder="Enter a team"
                            class="form-control @error('a_team') is-invalid @enderror">

                        @error('a_team')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">B Team</label>
                        <input id="b_team" type="text" name="b_team" value="{{$data->b_team}}" placeholder="Enter b team"
                            class="form-control @error('b_team') is-invalid @enderror">

                        @error('b_team')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">C Team</label>
                        <input id="c_team" type="text" name="c_team" value="{{$data->c_team}}" placeholder="Enter c team"
                            class="form-control @error('c_team') is-invalid @enderror">

                        @error('c_team')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <h5>Income</h5>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input id="amount" type="text" name="amount" value="{{$data->amount}}" placeholder="Enter amount"
                            class="form-control @error('amount') is-invalid @enderror">

                        @error('amount')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Days</label>
                        <input id="days" type="text" name="days" value="{{$data->days}}" placeholder="Enter days"
                            class="form-control @error('days') is-invalid @enderror">

                        @error('days')
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
         
        $('#rank_rewards').validate({
            rules: {
                rank_name: {
                    required: true,
                },
                a_team: {
                    required: true,
                    digits: true
                },
                b_team: {
                    required: true,
                    digits: true
                },
                c_team: {
                    required: true,
                    digits: true
                },
                amount: {
                    required: true,
                    number: true
                },
                days: {
                    required: true,
                    digits: true
                },
            },
            messages: {
                rank_name: {
                    required: "This field is required",
                },
                a_team: {
                    required: "This field is required",
                },
                b_team: {
                    required: "This field is required",
                },
                c_team: {
                    required: "This field is required",
                },
                amount: {
                    required: "This field is required",
                },
                days: {
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