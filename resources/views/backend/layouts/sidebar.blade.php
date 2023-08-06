<!-- Sidebar -->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <!-- HOME -->
            <li>
                <a href="{{ route('admin.dashboard.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <!-- HOME -->
            <!-- USER -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">User</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{route('admin.users.index')}}">
                            <p>All</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.active.users')}}">
                            <p>Active</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.inactive.users')}}">
                            <p>Inactive</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.banned.users')}}">
                            <p>Banned</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.trashed.index')}}">
                            <p>Trashed</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- USER -->
            <!-- PAYMENT QR -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-qrcode"></i>
                    <span class="nav-text">Payment QR</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{route('admin.payment-qr.index')}}">
                            <p>All</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.payment-qr.create')}}">
                            <p>Create</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.payment-qr.trashed.index')}}">
                            <p>Trashed</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- PAYMENT QR -->
            <!-- NOTICE -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="far fa-flag"></i>
                    <span class="nav-text">Notice</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{route('admin.notices.index')}}">
                            <p>All</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.notices.create')}}">
                            <p>Create</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.notice.trashed.index')}}">
                            <p>Trashed</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- NOTICE -->
            <!-- ADD FUND -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-random"></i>
                    <span class="nav-text">Add Fund</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{route('admin.funds.index')}}">
                            <p>All</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.funds.create')}}">
                            <p>Create</p>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <!-- ADD FUND -->
            <!-- PASSBOOK -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-book"></i>
                    <span class="nav-text">Passbook</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{route('admin.passbooks.index')}}">
                            <p>All</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- PASSBOOK -->
            <!-- PAYMENT REQUEST -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-cash-register"></i>
                    <span class="nav-text">Payment Manage</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{route('admin.request.index')}}">
                            <p>Pending Payment</p>
                        </a>
                    </li>
                </ul>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.payment.approved')}}">
                            <p>Approved Payment</p>
                        </a>
                    </li>
                </ul>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.payment.canceled')}}">
                            <p>Canceled Payment</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- PAYMENT REQUEST -->
            <!--GLOBAL MANAGE-->
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-globe"></i>
                        <span class="nav-text">Global Manage</span>
                    </a>
                    <ul aria-expanded="false">
                        <!-- PLANS -->
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Plans</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('admin.plans.index')}}">All</a></li>
                                <li><a href="{{route('admin.plans.create')}}">Create</a></li>
                                <li><a href="{{route('admin.plan.trashed.index')}}">Trashed</a></li>
                            </ul>
                        </li>
                        <!-- PLANS -->
                         <!-- GLOBAL LEVEL -->
                         <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Global Level</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('admin.globals.index')}}">All</a></li>
                                <li><a href="{{route('admin.globals.create')}}">Create</a></li>
                                <!-- <li><a href="{{route('admin.plan.trashed.index')}}">Trashed</a></li> -->
                            </ul>
                        </li>
                        <!-- GLOBAL LEVEL -->
                        
                    </ul>
                </li>
            <!--GLOBAL MANAGE-->
            <!--Bonus-->
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fas fa-level-up-alt"></i>
                        <span class="nav-text">Level Bonus</span>
                    </a>
                    <ul aria-expanded="false">
                        <!-- LEVEL -->
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Levels</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('admin.levels.index')}}">All</a></li>
                                <li><a href="{{route('admin.levels.create')}}">Create</a></li>
                                <li><a href="{{route('admin.level.trashed.index')}}">Trashed</a></li>
                            </ul>
                        </li>
                        <!-- LEVEL -->
                        <!-- LEVEL BONUS -->
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Bonus</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('admin.bonus.index')}}">All</a></li>
                                <li><a href="{{route('admin.bonus.create')}}">Create</a></li>
                                <li><a href="{{route('admin.bonus.trashed.index')}}">Trashed</a></li>
                            </ul>
                        </li>
                        <!-- LEVEL BONUS -->
                        
                    </ul>
                </li>
            <!--Bonus-->
            <!-- RANK AND REWARD BONUS -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-trophy"></i>
                    <span class="nav-text">Rank & Rewards</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{route('admin.rewards.index')}}">
                            <p>All</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.rewards.create')}}">
                            <p>Create</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.reward.trashed.index')}}">
                            <p>Trashed</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- RANK AND REWARD BONUS -->
            <!-- NOTIFICATION -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-ring"></i>
                    <span class="nav-text">Notifications</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.notifications.index')}}">
                            <p>All</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- NOTIFICATION -->
            <!--MASTERS-->
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-settings-7"></i>
                        <span class="nav-text">Masters</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('admin.settings.edit',['setting' => 1])}}">Settings</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Social Link</a>
                            <ul aria-expanded="false">
                                <li><a href="{{route('admin.social-links.index')}}">All</a></li>
                                <li><a href="{{route('admin.social-links.create')}}">Create</a></li>
                                <li><a href="{{route('admin.social-link.trashed.index')}}">Trashed</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('admin.email-configurations.edit',['email_configuration' => 1])}}">Email Configuration</a></li>
                        <li><a href="{{route('admin.roles.index')}}">Roles</a></li>
                        
                    </ul>
                </li>
            <!--MASTERS-->

            <!-- Profile -->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span class="nav-text">My Account</span>
                </a>

                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.profile.index') }}">
                            <p>Profile</p>
                        </a>
                    </li>
                    <li><a href="{{route('admin.change.password')}}">
                            <p>Change Password</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Profile -->

            






            <!--LOGOUT-->
            <li>
                <a href="{{ route('admin.logout') }}" class="ai-icon"
                    onclick="event.preventDefault(); $('#logout-form').submit();">
                    <i class="flaticon-381-exit-2"></i>
                    <span class="nav-text">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </li>
            <!--/. LOGOUT-->
        </ul>
    </div>
</div>
<!-- /.sidebar -->
