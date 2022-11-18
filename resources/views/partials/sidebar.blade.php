@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            @can('users_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('pocontract_manage')
            <li class="{{ $request->segment(2) == 'pocontract' ? 'active' : '' }}">
                <a href="{{ route('admin.pocontract.index') }}">
                    <i class="fa fa-file"></i>
                    <span class="title">@lang('global.pocontract-management.title')</span>
                </a>
            </li>
            @endcan
            @can('checking_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.checking.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('create_checking_form')
                    <li class="{{ $request->segment(2) == 'check' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.check.index') }}">
                            <i class="fa fa-plus"></i>
                            <span class="title">
                                @lang('global.create')
                            </span>
                        </a>
                    </li>
                    @endcan
                    @can('to_check')
                    <li class="{{ $request->segment(2) == 'tocheck' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.tocheck.index') }}">
                            <i class="fa fa-check"></i>
                            <span class="title">
                                @lang('global.check')
                            </span>
                        </a>
                    </li>
                    @endcan
                    @can('check_completed')
                    <li class="{{ $request->segment(2) == 'store-code' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.store-code.index') }}">
                            <i class="fa fa-list-alt"></i>
                            <span class="title">
                                @lang('global.checked')
                            </span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('store_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-industry" aria-hidden="true"></i>
                    <span class="title">@lang('global.store.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'stock' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.stock.request') }}">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <span class="title">Stock Request</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'issue' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.stock_issue.index') }}">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            <span class="title">Stock Issue</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'store' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.store.index') }}">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                            <span class="title">Store</span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'search' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.store.search') }}">
                        <i class="fa fa-search" aria-hidden="true"></i>
                            <span class="title">Store Search & Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('setting_manage')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span class="title">@lang('global.setting')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'supplier' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.supplier.index') }}">
                            <i class="fa fa-industry"></i>
                            <span class="title">
                                @lang('global.supplier.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'unit' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.unit.index') }}">
                            <i class="fa fa-balance-scale"></i>
                            <span class="title">
                                @lang('global.unit.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'division' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.division.index') }}">
                            <i class="fa fa-globe"></i>
                            <span class="title">
                                @lang('global.region.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'currency' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.currency.index') }}">
                            <i class="fa fa-dollar"></i>
                            <span class="title">
                                Currency
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}