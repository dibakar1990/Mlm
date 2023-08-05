@extends('frontend.layouts.main')
@section('title', 'Dashboard')
@section('content')
@section('css')
<link rel="stylesheet" href="{{ url('frontend/dist/css/dashboard.css')}}">
@endsection
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @if($notice)
    <div class="content-header">
      <div class="container-fluid">
        <div class="container"> 
          <div class="ticker"> 
            <div class="title"><h5>Breaking News</h5></div> 
            <div class="news"> 
              <marquee class="news-content"> <p>{{$notice->notice_name}} </p> </marquee> 
            </div> 
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </div>
    @endif
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Share Link</h3>

                <p>{!! $shareComponent !!}</p>
              </div>
              <div class="icon">
              <i class="fas fa-share-alt-square"></i>
              </div>
              
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$totalUserCount}}</h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalBannedUserCount}}</h3>

                <p>Banned Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{route('banned.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$totalActiveUserCount}}</h3>

                <p>Active Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{route('active.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalInactiveUserCount}}</h3>

                <p>Inactive User</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{route('inactive.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->
        @if($notice)
        <div class="row">
          <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Notice</h3>
                    
                  </div>
                </div>
                <div class="card-body">
                  <p><img src="{{$notice->file_url}}" class="img-fluid" alt="Responsive image"></p></p>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
        </div>
        @endif
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Notice Modal -->
  @if($notice)
    <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><img src="{{$notice->file_url}}" class="img-fluid" alt="Responsive image"></p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  @endif
  <!-- Notice Modal -->
  @endsection
@section('js')
    <script>
        ; 
        $(window).on('load', function(){ 
          $('#noticeModal').modal('show');
        });
    </script>

@endsection