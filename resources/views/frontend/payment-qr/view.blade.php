@extends('frontend.layouts.main')
@section('title', 'Show')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="d-flex align-items-end px-1">
                        <h1 class="d-inline-block mr-4"><small class="text-muted">Payment QR</small></h1>

                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.payment-qr.index') }}" class="text-muted">Payment QR</a></li>
                        </ol>
                    </div>
                    
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="details-tab" data-toggle="pill" href="#details" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade active show" id="details" role="tabpanel" aria-labelledby="details-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card ">
                                                    <div class="card-header bg-light align-items-center">
                                                        <h3 class="card-title align-items-center mb-0 pt-1"> Payment QR Details</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Currency Name</th>
                                                                    <th>Network</th>
                                                                    <th>Status</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $data->currency_name }}</td>
                                                                    <td>{{ $data->network }}</td>
                                                                    <td> {!! ($data->status) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}</td>
                                                                    
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Address</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ isset($data->address)?$data->address:'' }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Image</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        @if($data->file_path!='')
                                                                            <img src="{{ $data->file_url }}"
                                                                            class="rounded border img-fluid mb-2" alt=""/>
                                                                        @else
                                                                            <img src="{{ url('backend/images/avatar/1.jpg') }}" id="logo_img_squre" class="rounded border img-fluid mb-2" alt="" />
                                                                        @endif
                                                                    </td>
                                
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('js')

@endsection
