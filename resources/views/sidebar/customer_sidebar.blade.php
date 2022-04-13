<!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li>
                                <a href="{{url('dashboard')}}" class="waves-effect">
                                    <i class="mdi mdi-speedometer"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                         
                            @if (  Auth::user()->hasRole('Customer')) 
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-chart-arc"></i>
                                    <span>Orders</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false"> 
                                        <li><a href="{{url('customer/quotation')}}">Reserve units</a></li>
                                        <li><a href="{{url('customer/accepted')}}">Ship ok units</a></li>
                                        <li><a href="{{url('customer/completed')}}">Released units</a></li>
                                </ul>
                                    
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-chart-arc"></i>
                                    <span>Payments</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false"> 
                                        <li><a href="{{url('customer/payments')}}">Payment Detail</a></li>
                                </ul>
                                    
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->