@extends('backend.layouts.app')

@section('title')
    Payment Request
@endsection

@section('styles')
    @parent
    <link href="{{url('backend/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{url('backend/multi-select/css/multi-select.css')}}" rel="stylesheet">
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Payment Request</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">
                        
                    </div>
                </div>
                <!-- row -->

                <div class="card mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Total Amount: {{$totalAmount}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example4" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>#</th>
                                                    <th>Screenshot </th>
                                                    <th>Amount</th>
                                                    <th>Name</th>
                                                    <th>Transaction ID</th>
                                                    <th>Status </th>
                                                    <th>Request Date </th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datums as $key =>$value)
                                                    <tr>
                                                        
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            @if($value->file_path!='')
                                                                <img src="{{ $value->file_url }}" alt="" class="rounded border img-fluid mb-2" width="100" height="100">
                                                            @else
                                                                <img src="{{ url('backend/images/avatar/1.jpg') }}" id="logo_img_squre" class="rounded border img-fluid mb-2" alt="" />
                                                            @endif
                                                        </td>
                                                        <td>{{ $value->request_amount }}</td>
                                                        <td>{{ $value->user->name }}</td>
                                                        <td>{{ $value->transaction_id }}</td>
                                                        <td>
                                                        <a class="dropdown-item" data-bs-target="#paymentRequestApproveCanceled"
                                                                        href="javascript:void(0);" data-bs-toggle="modal" title="Approved Request" 
                                                                        onclick="paymentRequest('{{ route('admin.request.approve', $value->id) }}')">
                                                                        <span class="badge light badge-danger">Pending</span>
                                                                    </a>
                                                        
                                                        </td>
                                                        <td>{{ Carbon\Carbon::parse($value->created_at)->format('M d Y h:i A') }}</td>
                                                        <td>
                                                            <div class="dropdown ms-auto text-right" style="cursor: pointer;">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{route('admin.request.show',['request' => $value->id])}}" title="View"><i class="fas fa-eye" style="color: blue;"></i> View</a>
                                                                <a class="dropdown-item" data-bs-target="#paymentRequestApproveCanceled"
                                                                        href="javascript:void(0);" data-bs-toggle="modal" title="Approved Request" 
                                                                        onclick="paymentRequest('{{ route('admin.request.approve', $value->id) }}')">
                                                                        <i class="fas fa-toggle-on pr-1" style="color: green;"></i> Approve Request
                                                                    </a>
                                                                    
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
    <script src="{{url('backend/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend/js/plugins-init/datatables.init.js')}}"></script>
    <script src="{{url('backend/multi-select/js/jquery.multi-select.js')}}"></script>
    
    @stack('scripts')
@endsection
