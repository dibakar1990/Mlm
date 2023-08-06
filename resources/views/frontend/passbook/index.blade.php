@extends('frontend.layouts.main')
@section('title', 'Passbooks')
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
                <h1 class="d-inline-block mr-4"><small class="text-muted">Passbooks</small></h1>

                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Passbook</li>
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
                <h3 class="card-title">Passbook List</h3>
                <a href="{{route('user.passbook.export')}}" class="float-right btn btn-primary btn-xs" title="CSV export"><i class="fas fa-file-csv"></i></a>&nbsp;&nbsp;&nbsp;
                <a href="{{route('user.passbook.pdf')}}" target="_blank" class="float-right btn btn-success btn-xs" title="PDF" style="margin-right: 10px !important;"><i class="fas fa-file-pdf"></i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Unique ID</th>
                      <th>Name</th>
                      <th>Credit</th>
                      <th>Debit </th>
                      <th>Current Balance</th>
                      <th>Date</th>
                      <th><i class="fa fa-bars"></i> </th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($datums as $key => $value)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $value->user->unique_code }}</td>
                          <td>{{ $value->user->name }}</td>
                          <td>{{ $value->credit_amount }}</td>
                          <td>{{ $value->debit_amount }}</td>
                          <td>{{ $value->current_balance }}</td>
                          <td>{{ Carbon\Carbon::parse($value->created_at)->format('M d Y h:i A') }}</td>
            
                          <td class="text-center" style="width: 1px">
                              <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu dropdown-menu-right" style="min-width: 8rem;">
                                  
                                  <a class="dropdown-item text-muted" 
                                      href="{{route('user.passbook.show',$value->id)}}" 
                                      title="View">
                                      <i class="fas fa-eye pr-1"></i> View
                                    </a>
                                    <a class="dropdown-item text-muted" 
                                      href="{{route('user.passbook.export')}}" 
                                      title="Export">
                                      <i class="fas fa-file-csv"></i>  Export
                                    </a>
                                    <a class="dropdown-item text-muted" 
                                      href="{{route('user.passbook.pdf')}}" 
                                      title="PDF" target="_blank">
                                      <i class="fas fa-file-pdf"></i>  PDF
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


