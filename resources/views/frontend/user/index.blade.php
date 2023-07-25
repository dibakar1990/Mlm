@extends('frontend.layouts.main')
@section('title', 'Users')
@section('css')
<link rel="stylesheet" href="{{ url('frontend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ url('frontend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ url('frontend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="d-flex align-items-end px-1">
                <h1 class="d-inline-block mr-4"><small class="text-muted">Users</small></h1>

                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All User</li>
                </ol>
            </div>
            <div class="col-sm-2">
                
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div id="status_msg"></div>
       <div id="notify"> @include('frontend.layouts.alerts')</div>
       
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User List</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Unique ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number </th>
                      <th>Status</th>
                      <th>Join Date</th>
                      <th><i class="fa fa-bars"></i> </th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $key => $value)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $value->unique_code }}</td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->email }}</td>
                          <td>{{ $value->phone }}</td>
                          <td>
                          {!! ($value->status) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' !!}
                          </td>
                          <td>{{ Carbon\Carbon::parse($value->date_of_joning)->format('M d Y') }}</td>
            
                          <td class="text-center" style="width: 1px">
                              <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu dropdown-menu-right" style="min-width: 8rem;">
                                  
                                  <a class="dropdown-item text-muted" 
                                      href="{{route('user.show',$value->id)}}" 
                                      title="View" >
                                      <i class="fas fa-eye pr-1"></i> View
                                    </a>
                                  
                              </div>
                          </td>
                        </tr>
                      @endforeach
                        
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('js')
<script src="{{ url('frontend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ url('frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ url('frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ url('frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ url('frontend/dist/js/pages/table.js')}}"></script>


@endsection


