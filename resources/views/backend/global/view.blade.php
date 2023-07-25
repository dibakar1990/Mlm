@extends('backend.layouts.app')

@section('title')
    Global Level Show
@endsection

@section('styles')
    @parent
    <link href="{{url('backend/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    @stack('styles')
@endsection

@section('content')
<div class="content-body">
            <div class="container-fluid">
               
                <div class="row ">
                    <div class="col-sm-6 d-flex align-items-center">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.globals.index') }}">Globals</a></li>
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
                                    <h4 class="card-title">Global Level Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-body p-4">
                                        <div class="row justify-content-center">
                                            <div class="col-md-3 col-sm-6">
                                               <h5>{{$data->globalPlan->plan_name}}</h5>
                                                @if($data->status == 1)
                                                    <span class="badge light badge-success">Active</span>
                                                @else
                                                    <span class="badge light badge-danger">Inactive</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="example4" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Level Name</th>
                                                    <th>Level </th>
                                                    <th>Team </th>
                                                    <th>Amount </th>
                                                    <th>Total Amount </th>
                                                    <th>Recycle </th>
                                                    <th>Upgrade </th>
                                                    <th>Double Recycle </th>
                                                    <th>Direct </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data->globalLevelGeneration as $key =>$value)
                                                    <tr>
                                                        
                                                        <td>{{ $value->level_name }}</td>
                                                        <td>{{ $value->level }}</td>
                                                        <td>{{ $value->team }}</td>
                                                        <td>{{ $value->amount }}</td>
                                                        <td>{{ $value->total_amount }}</td>
                                                        <td>{{ $value->recycle }}</td>
                                                        <td>{{ $value->upgrade }}</td>
                                                        <td>{{ $value->double_recycle }}</td>
                                                        <td>{{ $value->direct }}</td>
                                                        
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
