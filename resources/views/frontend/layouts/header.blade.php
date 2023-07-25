<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- User Account: style can be found in dropdown.less -->
      <li class="nav-item dropdown user user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          @if(Auth::user()->avatar!='')
            <img src="{{ Auth::user()->avatar_url }}" class="user-image img-circle elevation-2 alt="User Image">
          @else
            <img src="{{ url('backend/images/avatar/1.jpg') }}" class="user-image img-circle elevation-2 alt="User Image">
          @endif
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            
            @if(Auth::user()->avatar!='')
              <img src="{{ Auth::user()->avatar_url  }}" class="img-circle elevation-2" alt="User Image">
            @else
              <img src="{{ url('backend/images/avatar/1.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @endif
            <p>
              {{ Auth::user()->name }} 
              <small>Member since {{ \Carbon\Carbon::parse(Auth::user()->updated_at)->format('M, Y') }}</small>
            </p>
          </li>

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="float-left">
              <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="float-right">
            <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat"
                    onclick="event.preventDefault(); $('#logout-form').submit();">Logout
                </a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                    class="d-none">
                    @csrf
                </form>
              
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
    </ul>
  </nav>
