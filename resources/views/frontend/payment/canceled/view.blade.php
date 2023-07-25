@extends('frontend.layouts.main')
@section('title', 'Canceled Payment Show')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="d-flex align-items-end px-1">
                        <h1 class="d-inline-block mr-4"><small class="text-muted">Canceled Payment</small></h1>

                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.payment.canceled') }}" class="text-muted">Canceled Payment</a></li>
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
                                                        <h3 class="card-title align-items-center mb-0 pt-1"> Canceled Payment Details</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card-body p-4">
                                                            <div class="row justify-content-center">
                                                                @if($data->file_path!='')
                                                                <img src="{{ $data->file_url }}" id="profile_img" style="height: 200px;width: 200px;"
                                                                    class="rounded border img-fluid mb-2" alt="" />
                                                                @else
                                                                <img src="{{ url('backend/images/avatar/1.jpg') }}" id="profile_img"
                                                                    class="rounded border img-fluid mb-2" alt="" />
                                                                @endif
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Amount</label>
                                                                        <input type="text" value="{{ $data->request_amount }}" class="form-control"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Transaction ID</label>
                                                                        <input type="text" value="{{ $data->transaction_id }}" class="form-control"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Status</label>
                                                                        <input type="text" value="Pending" class="form-control"
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
                                                                        <label class="form-label">Remark</label>
                                                                        <input type="text"  value="{{ $data->remark }}" class="form-control"
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
