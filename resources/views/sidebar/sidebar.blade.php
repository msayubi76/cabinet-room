<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{url('/')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        {{--<span class="badge badge-pill badge-danger float-right">9+</span>--}}
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->hasAnyPermission(['user.list', 'role.list']) || Auth::user()->hasRole('Super Admin'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-briefcase-check"></i>
                        <span>User Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @can('user.list')
                            <li><a href="{{url('user')}}">User</a></li>
                        @endcan
                        @can('role.list')
                            <li><a href="{{url('role')}}">Role</a></li>
                        @endcan
                         

                        {{--@can('permission.list')--}}
                        {{--<li><a href="{{url('permission')}}">Permission</a></li>--}}
                        {{--@endcan--}}
                        {{--@can('permission.create')--}}
                        {{--<li><a href="{{url('permission/create')}}">Create Permission</a></li>--}}
                        {{--@endcan--}}
                    </ul>
                </li>
           @endif
          
          
           @if (Auth::user()->hasAnyPermission(['product.list','category.list', 'sub_category.list']) || Auth::user()->hasRole('Super Admin'))
           <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
                   <i class="mdi mdi-chart-arc"></i>
                   <span>Manage Product</span>
               </a>
               <ul class="sub-menu" aria-expanded="false"> 
                       @can('product.list')
                       <li><a href="{{url('product')}}">Product List</a></li>
                       @endcan
                      
                       @can('category.list')
                            <li><a href="{{url('category')}}">Category</a></li>
                        @endcan
                        @can('sub_category.list')
                            <li><a href="{{url('sub_category')}}">Sub Category</a></li>
                        @endcan
               </ul>
              
           </li>
           @endif

           
          
           @if (Auth::user()->hasAnyPermission(['jdm_part.list' ]) || Auth::user()->hasRole('Super Admin'))
           <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
                   <i class="mdi mdi-chart-arc"></i>
                   <span>Manage Parts</span>
               </a>
               <ul class="sub-menu" aria-expanded="false"> 
                       @can('jdm_part.list')
                       <li><a href="{{url('jdm_part')}}">Jdm Parts</a></li>
                       @endcan
                       
               </ul>
              
           </li>
           @endif

           
           @if (Auth::user()->hasAnyPermission(['order.in_process_list','order.quotation_list', 'order.completed_list', 'order.rejected_list']) || Auth::user()->hasRole('Super Admin'))
           <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
                   <i class="mdi mdi-chart-arc"></i>
                   <span>Manage Order</span>
               </a>
               <ul class="sub-menu" aria-expanded="false"> 
                        @can('order.quotation_list')
                            <li><a href="{{url('quotation')}}">Reserve units</a></li>
                        @endcan 

                        @can('order.in_process_list')
                            <li><a href="{{url('order/in_process')}}">Ship ok units</a></li>
                        @endcan
                        
                        @can('order.completed_list')
                            <li><a href="{{url('order/completed')}}">Released units</a></li>
                        @endcan 
                        {{-- @can('order.rejected_list')
                            <li><a href="{{url('order/rejected')}}">Rejected Orders</a></li>
                        @endcan --}}
               </ul>
           </li>
           @endif 
           @if ( Auth::user()->hasRole('Super Admin'))
           <li>
               <a href="javascript: void(0);" class="has-arrow waves-effect">
                   <i class="mdi mdi-chart-arc"></i>
                   <span>Setting</span>
               </a>
               <ul class="sub-menu" aria-expanded="false"> 
                        @can('order.quotation_list')
                            <li><a href="{{url('general/setting')}}">General Setting</a></li>
                        @endcan 

                         
               </ul>
           </li>
           @endif 
           
           
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->