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
                        <h1 class="d-inline-block mr-4"><small class="text-muted">User</small></h1>

                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-muted">User</a></li>
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
                                                        <h3 class="card-title align-items-center mb-0 pt-1"> User Details</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Unique Code</th>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>Status</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $data->unique_code }}</td>
                                                                    <td>{{ $data->name }}</td>
                                                                    <td>{{ $data->email }}</td>
                                                                    <td>{{ $data->phone }}</td>
                                                                    <td> {!! ($data->status) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}</td>
                                                                    
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Country</th>
                                                                    <th>State</th>
                                                                    <th>City</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ isset($data->country->name)?$data->country->name:'' }}</td>
                                                                    <td>{{ isset($data->state->name)?$data->state->name:'' }}</td>
                                                                    <td>{{ isset($data->city)?$data->city:'' }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Wallet Amount</th>
                                                                    <th>Joning Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    
                                                                    <td>{{ isset($data->wallet_amount)?$data->wallet_amount:'' }}</td>
                                                                    <td>{{ Carbon\Carbon::parse($data->date_of_joning)->format('M d Y') }}</td>
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
                                                                        @if($data->avatar!='')
                                                                            <img src="{{ $data->avatar_url }}"
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
