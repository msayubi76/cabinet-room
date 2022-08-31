  <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('/admin')}}">Home</a></li>
                            <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-label">Users</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/users')}}">Sub-Users</a></li>
                            {{-- <li><a href="{{ url('/users')}}">Sub-Users</a></li> --}}
                            <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/roles')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Roles</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/roles')}}">Role List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/permissions')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Permissions</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/permissions')}}">permission List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/category')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Category</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/category')}}">Category List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/subcategory')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Sub Category</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/subcategory')}}">Sub Category List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/products')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Produts</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/products')}}">Products List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/orders')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Orders</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/orders')}}">Orders List</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/banners')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Banners</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('admin/banners')}}"> Banners</a></li>
                        </ul>


                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" href="{{ url('/settings')}}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Setting</span>
                        </a>
                        <ul aria-expanded="false">


                            <li><a href="  {{url('admin/settings/1/edit')}}"> Setting</a></li>





                        </ul>


                    </li>


                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
