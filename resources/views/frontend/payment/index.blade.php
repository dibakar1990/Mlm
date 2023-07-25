@extends('frontend.layouts.main')
@section('title', 'Pending Payment Request')
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
                <h1 class="d-inline-block mr-4"><small class="text-muted">Pending Payment</small></h1>

                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Pending Payment</li>
                </ol>
            </div>
            <div class="col-sm-2">
                <a href="{{ route('user.payment.request.create') }}" class="btn btn-sm btn-outline-primary float-right" title="Payment Request">
                    <i class="fas fa-plus"></i>
                </a>
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
                <h3 class="card-title">Payment Request List</h3>
                <a href="javascript:void(0);" class="nav-link float-right">
                <h3 class="card-title">Total Pending Amount: {{$totalAmount}}</h3> 
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Screenshot </th>
                      <th>Amount</th>
                      <th>Name</th>
                      <th>Transaction ID</th>
                      <th>Status </th>
                      <th>Request Date </th>
                      <th><i class="fa fa-bars"></i> </th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($datums->paymentRequest as $key => $value)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>
                            @if($value->file_path!='')
                              <img src="{{ $value->file_url }}" alt="" class="img-fluid rounded" width="100" height="auto">
                            @else
                              <img src="{{ url('backend/images/avatar/1.jpg') }}" id="logo_img_squre" class="rounded border img-fluid mb-2" alt="" />
                            @endif
                          </td>
                          <td>{{ $value->request_amount }}</td>
                          <td>{{ $datums->name }}</td>
                          <td>{{ $value->transaction_id }}</td>
                          <td>
                          <span class="badge badge-danger">Pending</span>
                          </td>
                          <td>
                          {{ Carbon\Carbon::parse($value->created_at)->format('M d Y h:i A') }}
                          </td>
                          <td class="text-center" style="width: 1px">
                              <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                              <div class="dropdown-menu dropdown-menu-right" style="min-width: 8rem;">
                                  
                                  <a class="dropdown-item text-muted" 
                                      href="{{route('user.payment.request.show',$value->id)}}" 
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


