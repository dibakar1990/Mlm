<?php $setting = Setting();?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('user.dashboard.index') }}" class="brand-link">
        @if($setting->file_path_squre!='')
            <img src="{{ $setting->file_url }}" alt=""
            class="brand-image img-circle elevation-3" style="opacity: .8">
        @else
            <img src="{{ url('backend/images/avatar/1.jpg') }}" alt=""
            class="brand-image img-circle elevation-3" style="opacity: .8">
        @endif
        <span class="brand-text font-weight-light">{{ $setting->title }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column text-sm nav-compact"
                data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('user.dashboard.index') }}"
                        class="nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- USER -->
                <li class="nav-item @if(request()->is('users*') || request()->is('active*') || request()->is('inactive*') || request()->is('banned*')){{ 'menu-open' }}@endif">
                    <a href="" class="nav-link @if(request()->is('users*') || request()->is('active*') || request()->is('inactive*') || request()->is('banned*')){{ 'active' }}@endif">
                        <i class="fas fa-users"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('active.users') }}" class="nav-link {{ request()->is('active*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Active</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inactive.users') }}" class="nav-link {{ request()->is('inactive*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Inactive</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('banned.users') }}" class="nav-link {{ request()->is('banned*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Banned</p>
                            </a>
                        </li>
                    </ul>
                    
                </li>
                <!-- USER -->
                <!-- PAYMENT QR -->
                <li class="nav-item @if(request()->is('user/payment-qr*')){{ 'menu-open' }}@endif">
                    <a href="" class="nav-link @if(request()->is('user/payment-qr*')){{ 'active' }}@endif">
                        <i class="fas fa-qrcode"></i>
                        <p>
                            Payment QR
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.payment-qr.index') }}" class="nav-link {{ request()->is('user/payment-qr*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    </ul>
                    
                </li>
                <!-- PAYMENT QR -->
                <!-- ADD FUND -->
                <li class="nav-item @if(request()->is('user/funds*') || request()->is('user/fund/create*')){{ 'menu-open' }}@endif">
                    <a href="" class="nav-link @if(request()->is('user/funds*') || request()->is('user/fund/create*')){{ 'active' }}@endif">
                        <i class="fas fa-random"></i>
                        <p>
                            Add Fund
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.funds.index') }}" class="nav-link {{ request()->is('user/funds*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.funds.create') }}" class="nav-link {{ request()->is('user/fund/create*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                    
                </li>
                <!-- ADD FUND -->
                <!-- PASSBOOK -->
                <li class="nav-item @if(request()->is('user/passbooks*')){{ 'menu-open' }}@endif">
                    <a href="" class="nav-link @if(request()->is('user/passbooks*')){{ 'active' }}@endif">
                        <i class="fas fa-book"></i>
                        <p>
                           Passbook
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.passbooks.index') }}" class="nav-link {{ request()->is('user/passbooks*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>All</p>
                            </a>
                        </li>
                    </ul>                    
                </li>
                <!-- PASSBOOK -->
                <!-- PASSBOOK -->
                <li class="nav-item @if(request()->is('user/payment*') || request()->is('user/payment/pending*') || request()->is('user/payment/approved*') || request()->is('user/payment/canceled*') || request()->is('user/payment/request*')){{ 'menu-open' }}@endif">
                    <a href="" class="nav-link @if(request()->is('user/payment*') || request()->is('user/payment/pending*') || request()->is('user/payment/approved*') || request()->is('user/payment/canceled*') || request()->is('user/payment/request*')){{ 'active' }}@endif">
                        <i class="fas fa-cash-register"></i>
                        <p>
                           Payment Request Manage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.payment.request.create') }}" class="nav-link {{ request()->is('user/payment/request*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Payment Request</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.payment.pending.request.index') }}" class="nav-link {{ request()->is('user/payment/pending*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Pending Payment</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.payment.approved') }}" class="nav-link {{ request()->is('user/payment/approved*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Approved Payment</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.payment.canceled') }}" class="nav-link {{ request()->is('user/payment/canceled*') ? 'active' : '' }}">
                                <i class="fas fa-arrow-right nav-icon"></i>
                                <p>Canceled Payment</p>
                            </a>
                        </li>
                    </ul>                           
                </li>
                <!-- PASSBOOK -->
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
