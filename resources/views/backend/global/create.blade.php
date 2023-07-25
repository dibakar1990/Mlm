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
            <li class="breadcrumb-item active"><a href="{{route('admin.globals.index')}}">Global Level</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="plan" action="{{route('admin.globals.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        
        <div class="card-body p-4">
            <div class="row justify-content-center">
               
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Plan Name</label>
                        <select name="plan_id" id="plan_id" class="js-example-theme-single form-control wide mb-3 @error('plan_id') is-invalid @enderror">
                            <option value="">Select Plan Name</option>
                            @foreach($items as $plan)
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
                <div id="input_fields_wrap">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card-header">
                                <h4 class="card-title">Level-1</h4>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="padding-top: 30px !important;">
                                <button class="btn btn-primary add_field_button">Add More</button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" value="1" name="levelValue[0][level]">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Team</label>
                                <input id="team_0" type="text" name="levelValue[0][team]" value="{{old('team')}}" placeholder="Enter team"
                                    class="form-control @error('levelValue[0][team]') is-invalid @enderror">
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Income</label>
                                <input id="income_0" type="text" name="levelValue[0][income]" value="{{old('income[]')}}" placeholder="Enter income"
                                    class="form-control @error('levelValue[0][income]') is-invalid @enderror">
                                @error('income[]')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Recycle</label>
                                <input id="recycle_0" type="text" name="levelValue[0][recycle]" value="{{old('recycle')}}" placeholder="Enter recycle"
                                    class="form-control @error('levelValue[0][recycle]') is-invalid @enderror">
                                @error('recycle[]')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Upgrade</label>
                                <input id="upgrade_0" type="text" name="levelValue[0][upgrade]" value="{{old('upgrade')}}" placeholder="Enter upgrade"
                                    class="form-control @error('levelValue[0][upgrade]') is-invalid @enderror">
                                @error('upgrade[]')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Double Recycle</label>
                                <input id="double_recycle_0" type="text" name="levelValue[0][double_recycle]" value="{{old('double_recycle')}}" placeholder="Enter double recycle"
                                    class="form-control @error('levelValue[0][double_recycle]') is-invalid @enderror">
                                @error('double_recycle[]')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Direct</label>
                                <input id="direct_0" type="text" name="levelValue[0][direct]" value="{{old('direct')}}" placeholder="Enter direct"
                                    class="form-control @error('levelValue[0][direct]') is-invalid @enderror">
                                @error('direct[]')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
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
         $("#plan_id").select2();
        $('#plan').validate({
        rules: {
            plan_id: {
                required: true,
            },
            "levelValue[0][team]": {
                required: true,
            },
            "levelValue[0][income]": {
                required: true,
            },
            "levelValue[0][recycle]": {
                required: true,
            },
            "levelValue[0][upgrade]": {
                required: true,
            },
            "levelValue[0][double_recycle]": {
                required: true,
            },
            "levelValue[0][direct]": {
                required: true,
            },
        },
        messages: {
            plan_id: {
                required: "This field is required",
            },
            "levelValue[0][team]": {
                required: "This field is required",
            },
            "levelValue[0][income]": {
                required: "This field is required",
            },
            "levelValue[0][recycle]": {
                required: "This field is required",
            },
            "levelValue[0][upgrade]": {
                required: "This field is required",
            },
            "levelValue[0][double_recycle]": {
                required: "This field is required",
            },
            "levelValue[0][direct]": {
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
    
    //add more field
    
    var wrapper         = $("#input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var levelCount = 2; //initlal text box count
    var i = 1;
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        
        $(wrapper).append('<div id="global_level_div_'+i+'"><div class="row"><div class="col-md-9"><div class="card-header"><h4 class="card-title">Level-'+levelCount+'</h4></div></div></div><div class="row"><input type="hidden" value="'+levelCount+'" name="levelValue['+i+'][level]"><div class="col-md-3"><div class="form-group"><label class="form-label">Team</label><input id="team_'+i+'" type="text" name="levelValue['+i+'][team]" placeholder="Enter team" class="form-control"></div></div><div class="col-md-3"><div class="form-group"><label class="form-label">Income</label><input id="income_'+i+'" type="text" name="levelValue['+i+'][income]" placeholder="Enter income" class="form-control"></div></div><div class="col-md-3"><div class="form-group"><label class="form-label">Recycle</label><input id="recycle_'+i+'" type="text" name="levelValue['+i+'][recycle]" placeholder="Enter recycle" class="form-control"></div></div></div><div class="row"><div class="col-md-3"><div class="form-group"><label class="form-label">Upgrade</label><input id="upgrade_'+i+'" type="text" name="levelValue['+i+'][upgrade]" placeholder="Enter upgrade" class="form-control"></div></div><div class="col-md-3"><div class="form-group"><label class="form-label">Double Recycle</label><input id="double_recycle_'+i+'" type="text" name="levelValue['+i+'][double_recycle]" placeholder="Enter double recycle" class="form-control"></div></div><div class="col-md-3"><div class="form-group"><label class="form-label">Direct</label><input id="direct_'+i+'" type="text" name="levelValue['+i+'][direct]" placeholder="Enter direct" class="form-control"></div></div><div class="col-md-3"><div class="form-group"><a href="#" class="btn btn-danger remove_field" data-no="'+i+'">Remove</a></div></div></div></div></div>');

            i++;
            levelCount++; //text box increment
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        
        var num = $(this).attr('data-no');
        $('#global_level_div_'+num).remove();
    })
    </script>
    @stack('scripts')
@endsection