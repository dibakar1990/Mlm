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
            <li class="breadcrumb-item active"><a href="{{route('admin.globals.edit',['global' => $data->id])}}">Global</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="plan" action="{{route('admin.globals.update',['global' => $data->id])}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
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
                            <option value="{{$plan->id}}" @if($data->global_plan_id == $plan->id){{'selected'}}@endif>{{$plan->plan_name}}</option>
                            @endforeach
                            
                        </select>
                        @error('plan_id')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card-header">
                            <span class="card-title">
                                If You Need More Field For Your Level , Please Click Here For Add More...
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="padding-top: 30px !important;">
                            <button class="btn btn-primary add_field_button">Add More</button>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div id="input_fields_wrap">
                        @foreach($data->globalLevelGeneration as $key => $generation)
                        <div class="row" id="level_generation_div_{{$key}}">
                            <div class="card-header">
                                <h4 class="card-title">Level-{{$generation->level}}</h4>
                                <a href="javascript:void(0);" class="btn btn-danger float-right remove_field" data-no="{{$key}}" style="margin-top: -310px !impotant;margin-bottom: 10px !impotant;">Remove</a>
                                <input type="hidden" value="{{$generation->level}}" name="levelValue[{{$key}}][level]">
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Team</label>
                                    <input id="team_{{$key}}" type="text" name="levelValue[{{$key}}][team]" value="{{$generation->team}}" placeholder="Enter team"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Income</label>
                                    <input id="income_{{$key}}" type="text" name="levelValue[{{$key}}][income]" value="{{$generation->amount}}" placeholder="Enter income"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Recycle</label>
                                    <input id="recycle_{{$key}}" type="text" name="levelValue[{{$key}}][recycle]" value="{{$generation->recycle}}" placeholder="Enter recycle"
                                        class="form-control">
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Upgrade</label>
                                    <input id="upgrade_{{$key}}" type="text" name="levelValue[{{$key}}][upgrade]" value="{{$generation->upgrade}}" placeholder="Enter upgrade"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Double Recycle</label>
                                    <input id="double_recycle_{{$key}}" type="text" name="levelValue[{{$key}}][double_recycle]" value="{{$generation->double_recycle}}" placeholder="Enter double recycle"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Direct</label>
                                    <input id="direct_{{$key}}" type="text" name="levelValue[{{$key}}][direct]" value="{{$generation->direct}}" placeholder="Enter direct"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        @endforeach
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
    <input type="hidden" id="last_id" value="{{count($data->globalLevelGeneration)}}">
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
            plan_name: {
                required: true,
            },
            amount: {
                required: true,
                number: true
            },
        },
        messages: {
            plan_name: {
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
    //add more level
    var wrapper = $("#input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID
    var count = $('#last_id').val();
    var x = count; //initlal text box count
    var level = 1;
    var levelCount = parseInt(x) + parseInt(level);
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();

        $(wrapper).append('<div class="row" id="level_generation_div_'+x+'"><div class="card-header"><h4 class="card-title">Level-'+levelCount+'</h4><a href="javascript:void(0);" class="btn btn-danger float-right remove_field" data-no="'+x+'" style="margin-top: -310px !impotant;margin-bottom: 10px !impotant;">Remove</a><input type="hidden" value="'+levelCount+'" name="levelValue['+x+'][level]"></div><div class="col-md-4"><div class="form-group"><label class="form-label">Team</label><input id="team_'+x+'" type="text" name="levelValue['+x+'][team]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label class="form-label">Income</label><input id="income_'+x+'" type="text" name="levelValue['+x+'][income]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label class="form-label">Recycle</label><input id="recycle_'+x+'" type="text" name="levelValue['+x+'][recycle]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label class="form-label">Upgrade</label><input id="upgrade_'+x+'" type="text" name="levelValue['+x+'][upgrade]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label class="form-label">Double Recycle</label><input id="double_recycle_'+x+'" type="text" name="levelValue['+x+'][double_recycle]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label class="form-label">Direct</label><input id="direct_'+x+'" type="text" name="levelValue['+x+'][direct]" class="form-control"></div></div></div>');
        x++; //text box increment
        levelCount++;
    });

    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        var num = $(this).attr('data-no');
        $('#level_generation_div_' + num).remove();
        x--;
        levelCount--;
    })
    </script>
    @stack('scripts')
@endsection