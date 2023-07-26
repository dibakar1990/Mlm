@extends('frontend.layouts.main')
@section('title', 'Subscriptions')
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
                <h1 class="d-inline-block mr-4"><small class="text-muted">Fund Transfer</small></h1>

                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Subscriptions</li>
                </ol>
            </div>
            <div class="col-sm-2">
                <a href="{{ route('user.subscriptions.create') }}" class="btn btn-sm btn-outline-primary float-right" title="Add subscription">
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
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Unique ID</th>
                      <th>User Name</th>
                      <th>Plan Name</th>
                      <th>Amount</th>
                      <th>Subscription  Date </th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($items as $key => $value)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>
                              {{$value->user->unique_code}}
                          </td>
                          <td>{{ $value->user->name }}</td>
                          <td>{{ $value->plan->plan_name }}</td>
                          <td>{{ $value->plan->amount }}</td>
                          
                          <td>
                          {{$value->subscription_date}}
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


