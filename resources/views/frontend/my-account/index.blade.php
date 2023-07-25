@extends('frontend.layouts.main')
@section('title', 'Profile')
@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{url('forntend/plugins/select2/css/select2.min.css')}}">
    <style>
            div#social-links {
                margin: 0 auto;
                max-width: 500px;
            }
            div#social-links ul li {
                display: inline-block;
            } 
            div#social-links ul li a {
                padding: 2px;
               
                margin: 1px;
                font-size: 30px;
               
            }         
            
        </style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div id="notify"> @include('frontend.layouts.alerts')</div>
        <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                @if($user->avatar!='')
                  <img class="profile-user-img img-fluid img-circle"
                      src="{{$user->avatar_url}}"
                      alt="User profile picture">
                @else
                  <img class="profile-user-img img-fluid img-circle"
                      src="{{url('backend/images/profile/pic1.jpg')}}"
                      alt="User profile picture">
                @endif
              </div>

              <h3 class="profile-username text-center">{{$user->name}}</h3>

             

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{$user->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="float-right">{{$user->phone}}</a>
                </li>
                <li class="list-group-item">
                  <b>Country</b> <a class="float-right">{{$user->country->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>State</b> <a class="float-right">{{$user->state->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>City</b> <a class="float-right">{{$user->city}}</a>
                </li>
                <li class="list-group-item">
                  <b>Refer Code</b> <a class="float-right">{{$user->unique_code}}</a>
                </li>
                <li class="list-group-item">
                  <b>Refer Link</b> <a class="float-right">{{route('signup.index',['ref_code' => $user->unique_code])}}</a>
                </li>
                <li class="list-group-item">
                  <b>Share Link</b> <a class="float-right">
                  {!! $shareComponent !!}
                  </a>
                </li>
              </ul>

             
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
          </div>
          <!-- /.col -->
         
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link @if((Session::get('tab_active') == 'profile') || empty(Session::get('tab_active'))){{'active'}} @endif" href="#userProfile" data-toggle="tab">Profile</a></li>
              
                  <li class="nav-item"><a class="nav-link @if(Session::get('tab_active') == 'change_password'){{'active'}}@endif" href="#change_password" data-toggle="tab">Change Password</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="@if((Session::get('tab_active') == 'profile') || empty(Session::get('tab_active'))){{'active'}} @endif tab-pane" id="userProfile">
                    <form class="form-horizontal" method="post" action="{{route('profile.update',['id' => $user->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label"> Name<span>*</span></label>
                          <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ $user->name }}">
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                          </div>
                        </div>
                       
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email<span>*</span></label>
                          <div class="col-sm-10">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email" value="{{ $user->email }}">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                          <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" min="10" max="10" id="phone" placeholder="Phone" value="{{ $user->phone }}">
                            {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="phone" class="col-sm-2 col-form-label">Country</label>
                          <div class="col-sm-10">
                              <select class="form-control select2" name="country_id" id="country_id" style="width: 100%;">
                                <option value="">--Select Country--</option>
                                @foreach($countries as $country)
                                  <option value="{{$country->id}}" @if($user->country_id == $country->id){{'selected'}}@endif>{{$country->name}}</option>
                                @endforeach
                              </select>
                            {!! $errors->first('country_id', '<span class="help-block">:message</span>') !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="phone" class="col-sm-2 col-form-label">Country</label>
                          <div class="col-sm-10">
                              <select class="form-control select2" name="state_id" id="state-dropdown" style="width: 100%;">
                                <option value="">--Select State--</option>
                                @foreach($states as $state)
                                  <option value="{{$state->id}}" @if($user->state_id == $state->id){{'selected'}}@endif>{{$state->name}}</option>
                                @endforeach
                              </select>
                            {!! $errors->first('state_id', '<span class="help-block">:message</span>') !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="city" class="col-sm-2 col-form-label">City</label>
                          <div class="col-sm-10">
                            <input type="text" name="city" class="form-control" id="city" placeholder="city" value="{{ $user->city }}">
                            {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-2 col-form-label">Image</label>
                          <div class="col-sm-10">
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="user_image" class="custom-file-input" id="exampleInputFile"  accept='.jpg, .jpeg, .png'>
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        
                        
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                          </div>
                        </div>
                      </form>
                  </div>

                  <div class="@if(Session::get('tab_active') == 'change_password'){{'active'}} @endif tab-pane" id="change_password">
                    <form class="form-horizontal" method="post" action="{{route('change.password',['id' => $user->id])}}">
                      @csrf
                      <div class="form-group row">
                        <label for="old_password" class="col-sm-2 col-form-label">Old Password<span>*</span></label>
                        <div class="col-sm-10">
                          <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="Old Password">
                          {!! $errors->first('old_password', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password<span>*</span></label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                          {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password<span>*</span></label>
                        <div class="col-sm-10">
                          <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Confirm Password">
                          {!! $errors->first('confirm_password', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                 
                </div>
                
              </div>
            </div>
           
          </div>
        
        </div>
      
      </div>
    </section>
   
  </div>
@endsection
@section('js')
  <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script> 
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script src="{{url('frontend/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{url('frontend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
 <script>
  $(function () {
    //Initialize Select2 Elements
   
    bsCustomFileInput.init();
  });
  $(document).on('change', '#country_id', function () {

    var idCountry = this.value;
    $("#state-dropdown").html('');
    $.ajax({
            url: "{{route('fetchState')}}",
            type: "POST",
            data: {
                country_id: idCountry,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#state-dropdown').html('<option value="">-- Select State --</option>');
                $.each(result.states, function (key, value) {
                    $("#state-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });


    });
 </script>
@endsection
