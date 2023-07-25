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
            <li class="breadcrumb-item active"><a href="{{route('admin.notices.index')}}">Notice</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
        </ol>
    </div>
    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">

    </div>
</div>


<div class="card mt-4">
    <form class="needs-validation" id="notice" action="{{route('admin.notices.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        
        <div class="card-body p-4">
            <div class="row justify-content-center">
               
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Notice Name</label>
                        <input id="notice_name" type="text" name="notice_name" placeholder="Enter notice name"
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
    
    @stack('scripts')
@endsection