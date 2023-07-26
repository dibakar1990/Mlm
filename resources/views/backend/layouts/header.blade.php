<div class="header">
  <div class="header-content">
      <nav class="navbar navbar-expand">
          <div class="collapse navbar-collapse justify-content-between">
              <div class="header-left">
                  <div class="dashboard_bar">
                  @yield('title')
                  </div>
              </div>

              <ul class="navbar-nav header-right">
                <li class="nav-item dropdown notification_dropdown">
                  <a class="nav-link  ai-icon" href="#" role="button" data-bs-toggle="dropdown">
                      <i class="flaticon-381-ring"></i>
                      <div class="pulse-css"></div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
                      <ul class="timeline">
                        
                        @if(auth()->user()->unreadNotifications->count() > 0)
                          @foreach(auth()->user()->unreadNotifications as $notification)
                            <li>
                              <div class="timeline-panel">
                                
                                <div class="media-body">
                                  <h6 class="mb-1">{{$notification->data['message']}}</h6>
                                  <small class="d-block">
                                  {{ Carbon\Carbon::parse($notification->created_at)->format('d F Y - h:i A') }}
                                    </small>
                                </div>
                                <div class="">
                                  <span class="badge light badge-primary">
                                    <button type="button" rel="tooltip" title="Mark as read" class="btn-close mark-as-read" data-id="{{ $notification->id }}" data-bs-dismiss="modal"></button>
                                  </span>
                                  
                                </div>
                              </div>
                            </li>
                          @endforeach
                        @else
                          <li>
                              <div class="timeline-panel">
                                
                                <div class="media-body">
                                  <h6 class="mb-1">There are no new notifications</h6>
                                  <small class="d-block">
                                  
                                    </small>
                                </div>
                                <div class="">
                                 
                                </div>
                              </div>
                            </li>
                        @endif
                      </ul>
                    </div>
                      <a class="all-notification" href="#" id="mark-all">Mark all as read <i class="ti-arrow-right"></i></a>
                  </div>
                </li>
                
               
                  <li class="nav-item dropdown header-profile">
                      <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                        @if(Auth::user()->avatar!='')
                          <img src="{{ Auth::user()->avatar_url }}" width="20" alt=""/>
                        @else  
                          <img src="{{url('backend/images/profile/pic1.jpg')}}" width="20" alt=""/>
                        @endif
                        <div class="header-info">
                          <span>{{Auth::user()->name}}</span>
                          <small>@if(Auth::user()->type == 1) {{ 'Super Admin' }} @endif</small>
                        </div>
                      </a>
                      <div class="dropdown-menu dropdown-menu-end">
                          <a href="{{route('admin.profile.index')}}" class="dropdown-item ai-icon">
                              <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                              <span class="ms-2">Profile </span>
                          </a>
                          <a href="{{route('admin.change.password')}}" class="dropdown-item ai-icon">
                            <i class="fa fa-key text-primary"></i>
                              <span class="ms-2">Change Password </span>
                          </a>
                          <a href="{{ route('admin.logout') }}" class="dropdown-item ai-icon"  onclick="event.preventDefault(); $('#logout-form').submit();">
                              <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                              <span class="ms-2">Logout </span>
                          </a>
                          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                          </form>
                      </div>
                  </li>
              </ul>
          </div>
      </nav>
  </div>
</div>