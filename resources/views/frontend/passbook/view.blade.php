@extends('frontend.layouts.main')
@section('title', 'Passbook Show')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="d-flex align-items-end px-1">
                        <h1 class="d-inline-block mr-4"><small class="text-muted">Passbooks</small></h1>

                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.passbooks.index') }}" class="text-muted">Passbooks</a></li>
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
                                                        <h3 class="card-title align-items-center mb-0 pt-1"> Passbook Details</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card-body p-4">
                                                            <div class="row justify-content-center">
                                                                <p>Current Balance : {{$data->current_balance }}</p>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Credit Amount</label>
                                                                        <input type="text" value="{{ $data->credit_amount }}" class="form-control"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Debit Amount</label>
                                                                        <input type="text" value="{{ $data->debit_amount }}" class="form-control"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Current Balance</label>
                                                                        <input type="text" value="{{ $data->current_balance }}" class="form-control"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Date</label>
                                                                        <input type="text" value="{{ Carbon\Carbon::parse($data->created_at)->format('M d Y h:i A') }}" class="form-control"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Purpose</label>
                                                                        <input type="text"  value="{{ $data->purpose }}" class="form-control"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div><!-- /.row -->
                                                            
                                                        </div>
                                                 
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
