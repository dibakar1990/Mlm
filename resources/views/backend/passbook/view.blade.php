@extends('backend.layouts.app')

@section('title')
    Passbook Show
@endsection

@section('styles')
    @parent
   
    @stack('styles')
@endsection

@section('content')
<div class="content-body">
            <div class="container-fluid">
               
                <div class="row ">
                    <div class="col-sm-6 d-flex align-items-center">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.passbooks.index') }}">Passbooks</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">view</a></li>
                        </ol>
                    </div>
                    
                </div>
                <!-- row -->

                <div class="card mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Passbook Details</h4>
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
                <div class="card mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body p-4">
                                        <div class="row justify-content-center">
                                            <div class="col-md-3 col-sm-12 text-center">
                                                @if($data->user->avatar!='')
                                                <img src="{{ $data->user->avatar_url }}" id="profile_img"
                                                    class="rounded border img-fluid mb-2" alt="" />
                                                @else
                                                <img src="{{ url('backend/images/avatar/1.jpg') }}" id="profile_img"
                                                    class="rounded border img-fluid mb-2" alt="" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Unique Code</label>
                                                    <input type="text" value="{{ $data->user->unique_code }}" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" value="{{ $data->user->name }}" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" value="{{ $data->user->email }}" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" value="{{ $data->user->phone }}" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Country</label>
                                                    <input type="text"  value="{{ $data->user->country->name }}" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">State</label>
                                                    <input type="text"  value="{{ $data->user->state->name }}" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">City</label>
                                                    <input type="text"  value="{{ $data->user->city }}" class="form-control"
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

        
@endsection
@section('scripts')
    @parent
   
    @stack('scripts')
@endsection
