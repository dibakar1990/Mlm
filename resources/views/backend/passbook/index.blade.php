@extends('backend.layouts.app')

@section('title')
    Passbook
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Passbooks</a></li>
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
                                <div class="card-header d-flex flex-row-reverse">
                                    <a href="{{route('admin.passbooks.export.csv')}}" class="btn btn-primary btn-xs" title="CSV export"><i class="fas fa-file-csv"></i></a>
                                    <a href="{{route('admin.passbooks.pdf.generate')}}" class="btn btn-primary btn-xs" title="PDF" style="margin-left:775px !important;"><i class="fas fa-file-pdf"></i></a>
                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example4" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>#</th>
                                                    <th>Unique ID</th>
                                                    <th>Name</th>
                                                    <th>Credit</th>
                                                    <th>Debit </th>
                                                    <th>Current Balance</th>
                                                    <th>Date</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datums as $key =>$value)
                                                    <tr>
                                                        
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $value->user->unique_code }}</td>
                                                        <td>{{ $value->user->name }}</td>
                                                        <td>{{ $value->credit_amount }}</td>
                                                        <td>{{ $value->debit_amount }}</td>
                                                        <td>{{ $value->current_balance }}</td>
                                                        <td>{{ Carbon\Carbon::parse($value->created_at)->format('M d Y h:i A') }}</td>
                                                        <td>
                                                            <div class="dropdown ms-auto text-right" style="cursor: pointer;">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="{{route('admin.passbooks.show',['passbook' => $value->id])}}" title="View"><i class="fas fa-eye" style="color: blue;"></i> View</a>
                                                                <a class="dropdown-item" href="{{route('admin.passbooks.export.csv')}}" title="Export"><i class="fas fa-file-csv" style="color: #363062;"></i> Export</a>
                                                                <a class="dropdown-item" href="{{route('admin.passbooks.pdf.generate')}}" title="PDF"><i class="fas fa-file-pdf" style="color: #363062;"></i> PDF</a>
                                                                   
                                                                    
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
