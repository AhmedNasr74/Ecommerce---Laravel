<header class="main-header">
    <!-- Logo -->
    <a href="{{admin_routes()}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      @include('admin.layouts.menu')

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{admin_design('')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Admin()->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

 <li class="treeview active_menu('admins')[0]">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ trans('admin.dashboard') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('admins')[1] }}">
                        <li class="">
                                <a href="{{ admin_routes() }}">
                                    <i class="fa fa-dashboard"></i> <span>{{ trans('admin.dashboard') }}</span>
                                </a>
                        </li>
                        <li class="">
                                <a href="{{ admin_routes('settings') }}">
                                    <i class="fa fa-gear"></i> <span>{{ trans('admin.settings') }}</span>
                                </a>
                        </li>
                    </ul>
            </li>

        <li class="treeview {{active_menu('admins')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-user"></i> <span>{{ trans('admin.account') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('admins')[1] }}">
                        <li class=""><a href="{{ admin_routes('admins') }}"><i class="fa fa-users"></i> {{ trans('admin.accounts') }}</a></li>
                    </ul>
            </li>

            <li class="treeview {{active_menu('users')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-user"></i> <span>{{ trans('admin.users') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('users')[1] }}">
                        <li class=""><a href="{{ admin_routes('users') }}"><i class="fa fa-users"></i> {{ trans('admin.all') }}</a></li>
                        <li class=""><a href="{{ admin_routes('users') }}?level=user"><i class="fa fa-users"></i> {{ trans('admin.user') }}</a></li>
                        <li class=""><a href="{{ admin_routes('users') }}?level=vendor"><i class="fa fa-users"></i> {{ trans('admin.vendor') }}</a></li>
                        <li class=""><a href="{{ admin_routes('users') }}?level=company"><i class="fa fa-users"></i> {{ trans('admin.company') }}</a></li>
                    </ul>
            </li>

            <li class="treeview {{active_menu('countries')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-globe"></i> <span>{{ trans('admin.countries') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('countries')[1] }}">
                        <li class=""><a href="{{ admin_routes('countries') }}"><i class="fa fa-flag-checkered"></i> {{ trans('admin.countries') }}</a></li>
                        <li class=""><a href="{{ admin_routes('countries/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('cities')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-globe"></i> <span>{{ trans('admin.cities') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('cities')[1] }}">
                        <li class=""><a href="{{ admin_routes('cities') }}"><i class="fa fa-flag-checkered"></i> {{ trans('admin.cities') }}</a></li>
                        <li class=""><a href="{{ admin_routes('cities/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('states')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-globe"></i> <span>{{ trans('admin.states') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('states')[1] }}">
                        <li class=""><a href="{{ admin_routes('states') }}"><i class="fa fa-flag-checkered"></i> {{ trans('admin.states') }}</a></li>
                        <li class=""><a href="{{ admin_routes('states/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('departments')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-list"></i> <span>{{ trans('admin.departments') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('departments')[1] }}">
                        <li class=""><a href="{{ admin_routes('departments') }}"><i class="fa fa-list"></i> {{ trans('admin.departments') }}</a></li>
                        <li class=""><a href="{{ admin_routes('departments/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('trademarks')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-cube"></i> <span>{{ trans('admin.trademarks') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('trademarks')[1] }}">
                        <li class=""><a href="{{ admin_routes('trademarks') }}"><i class="fa fa-cube"></i> {{ trans('admin.trademarks') }}</a></li>
                        <li class=""><a href="{{ admin_routes('trademarks/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
                </ul>
            </li>

            <li class="treeview {{active_menu('manufactures')[0] }}">
                <a href="{{ admin_routes('admins') }}">
                    <i class="fa fa-users"></i> <span>{{ trans('admin.manufactures') }}</span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('manufactures')[1] }}">
                        <li class=""><a href="{{ admin_routes('manufactures') }}"><i class="fa fa-users"></i> {{ trans('admin.manufactures') }}</a></li>
                        <li class=""><a href="{{ admin_routes('manufactures/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
                </ul>
            </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
