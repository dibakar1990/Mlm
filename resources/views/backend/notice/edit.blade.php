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
            <li class="breadcrumb-item active"><a href="{{route('admin.notices.edit',['notice' => $data->id])}}">Notice</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="notice" action="{{route('admin.notices.update',['notice' => $data->id])}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            
            <div class="row mt-4">
            <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Notice Name</label>
                        <input id="notice_name" type="text" name="notice_name" value="{{$data->notice_name}}" placeholder="Enter notice name"
                            class="form-control @error('notice_name') is-invalid @enderror">

                        @error('notice_name')
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
                            <input type="file" id="file" name="file" class="form-file-input form-control" accept='.jpg, .jpeg, .png'>
                        </div>
                    </div>
                </div>
               
                    @if($data->file_path!='')
                    <img src="{{ $data->file_url }}" id="code_img"
                        class="rounded border img-fluid mb-2" style="width:200px;" />
                    @else
                    <img src="{{ url('backend/images/avatar/1.jpg') }}" id="code_img"
                        class="rounded border img-fluid mb-2" style="width:200px;" alt="" />
                    @endif
                
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
    
    @stack('scripts')
@endsection