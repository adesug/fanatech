<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{route('superAdmin.home')}}" class="nav-link {{(request()->is('admin/home') || (request()->is('home'))) ? 'active' : ''}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Home
                  </p>
                </a>
              </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{(request()->is('admin/inventory*') || request()->is('admin/sales*') ? 'active' : '' || request()->is('admin/purchases*')) ? 'active' : ''}}">
                <i class="nav-icon fas fa-th"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.inventory')}}" class="nav-link {{(request()->is('admin/inventory*')) ? 'active' : ''}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.sales')}}" class="nav-link {{(request()->is('admin/sales*')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.purchases')}}" class="nav-link {{(request()->is('admin/purchases*')) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchases</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>