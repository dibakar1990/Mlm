@extends('backend.layouts.app')

@section('title')
    Add Fund
@endsection

@section('styles')
    @parent
    <link href="{{url('backend/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"> Add Fund</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">
                        <a type="button" href="{{ route('admin.funds.create') }}" class="btn btn-primary btn-xs">Add New</a>
                    </div>
                </div>
                <!-- row -->

                <div class="card mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                    <h4 class="card-title">Fees Collection</h4>
                                </div> -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example4" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Unique ID</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                    <th>Status </th>
                                                    <th>Added BY </th>
                                                    <th>Create Date </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datums as $key =>$value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        
                                                        <td>
                                                           {{$value->unique_code}}
                                                        </td>
                                                        <td>{{ $value->user->name ?? null }}</td>
                                                        <td>{{ $value->amount }}</td>
                                                        <td>
                                                            @if($value->status == 1)
                                                            <span class="badge light badge-success">Active</span>
                                                            @else
                                                            <span class="badge light badge-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $value->added_by }}</td>
                                                        <td>
                                                        {{ Carbon\Carbon::parse($value->created_at)->format('M d Y') }}
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
    
    @stack('scripts')
@endsection
