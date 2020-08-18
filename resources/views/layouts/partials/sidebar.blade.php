<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
               
                <li> <a class="waves-effect waves-dark" href="{{route('dashboard')}}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
               
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('district.list')}}">District</a></li>
                        <li><a href="{{route('upzilla.list')}}">Upzilla</a></li>
                        <li><a href="{{route('zone.list')}}">Zone</a></li>
                        <li><a href="{{route('subzone.list')}}">Sub Zone</a></li>
                        <li><a href="{{route('box.list')}}">Box</a></li>
                        <li><a href="{{route('cable.list')}}">Cable</a></li>
                        <li><a href="{{route('cable.list')}}">Payment Type</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-shine"></i><span class="hide-menu">Power setting </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('role.list')}}">Create Role</a></li>
                        <li><a href="#">Role Permission</a></li>
                       
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-tag"></i><span class="hide-menu">Package</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('package.create')}}">Create Package</a></li>
                        <li><a href="{{route('package.list')}}">Package Lists</a></li>
                       
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Users </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('user.create')}}">Add New User</a></li>
                        <li><a href="{{route('user.list')}}">All Users</a></li>
                        <li><a href="{{route('user.active')}}">Active User</a></li>
                        <li><a href="{{route('user.inactive')}}">In Active User</a></li>
                        <li><a href="{{route('user.block')}}">Block User</a></li>
                        <li><a href="{{route('user.download')}}">Download BTRC </a></li>
                       
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Staff </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('staff.create')}}">Add New Staff</a></li>
                        <li><a href="{{route('staff.list')}}">All Staff</a></li>
                        <li><a href="{{route('designation.list')}}">Manage Designation</a></li>
                       
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-money"></i><span class="hide-menu">Billing/Finance</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a href="{{route('payment.dashboard')}}">Dashboard</a></li>
                        <li><a href="{{route('invoice.create')}}">Create Invoices</a></li>
                        <li><a href="{{route('invoice.list')}}">Invoices</a></li>
                        <li><a href="{{route('payment.list')}}">Payments</a></li>
                        
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-support"></i><span class="hide-menu">Ticket Manage<span class="badge badge-pill badge-warning ml-auto">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('ticket.list')}}"><i class="ti-list"></i> All Ticket</a></li>
                        <li><a href="{{route('ticket.create')}}"><i class="ti-plus"></i> Create New Ticket</a></li>
                        <li><a href="{{route('ticket.create')}}"><i class="ti-trash"></i> Trash</a></li>
                        
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">SMS <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-email.html">Mailbox</a></li>
                        <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                        <li><a href="app-compose.html">Compose Mail</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-palette"></i><span class="hide-menu">Expenditure</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-email.html">Mailbox</a></li>
                        <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                        <li><a href="app-compose.html">Compose Mail</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-stats-up"></i><span class="hide-menu">API</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-email.html">Mailbox</a></li>
                        <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                        <li><a href="app-compose.html">Compose Mail</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-bar-chart"></i><span class="hide-menu">Reports</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-email.html">Transactions</a></li>
                        <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                        <li><a href="app-compose.html">Compose Mail</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-map-alt"></i><span class="hide-menu">Network Map</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-email.html">Mailbox</a></li>
                        <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                        <li><a href="app-compose.html">Compose Mail</a></li>
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-server"></i><span class="hide-menu">Stock</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('stockCategory')}}">Stock Category</a></li>
                        <li><a href="{{route('brand')}}">Brand</a></li>
                        <li><a href="{{route('stockShop')}}">Shop Name</a></li>
                        <li><a href="{{route('stock')}}">Add New Stock</a></li>
                    </ul>
                </li>
                
                
             
               
                <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"href="#" aria-expanded="false"><i class="fa fa-power-off text-success"></i><span class="hide-menu">Log Out</span></a></li>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                </form>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>