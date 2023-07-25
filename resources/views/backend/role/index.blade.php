@extends('backend.layouts.app')

@section('title')
    Role
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Role</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-6 d-flex flex-row-reverse align-items-center">
                        <a type="button" href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-xs">Add New</a>
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
                                                    <th>Name</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($roles as $key =>$value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $value->name }}</td>
                                                        <td>
                                                            <div class="dropdown ms-auto text-right" style="cursor: pointer;">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="{{route('admin.roles.edit',['role' => $value->id])}}" title="Edit"><i class="fas fa-pencil-alt" style="color: blue;"></i> Edit</a>
                                                                    <a class="dropdown-item" data-bs-target="#deleteConfirm" href="javascript:void(0);" 
                                                                        data-bs-toggle="modal" title="Delete" 
                                                                        onclick="deleteConfirm('{{ route('admin.roles.destroy',['role' => $value->id])}}')"><i class="fa fa-trash" style="color: red;"></i> Delete</a>
                                                                    
                                                                    
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
    
    @stack('scripts')
@endsection
