<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar"> -->
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/home') }}">
    <!-- <img src="{{ url('imgs/logo/logo.png') }}" alt="" style="max-height: 50px;"> -->
    {{ auth()->user()->role_id == 1 ? 'Admin Panel' : auth()->user()->name }}
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{  url('admin/home') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <hr class="sidebar-divider">
  @if(auth()->user()->role_id == 1)
  <div class="sidebar-heading">
    Master
  </div>

  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-folder"></i>
      <span>Master</span>
    </a>
    <div id="master" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('state.index') }}">State</a>
        <a class="collapse-item" href="{{ route('city.index') }}">City</a>
        <a class="collapse-item" href="{{ route('role.index') }}">Role</a>
      </div>
    </div>
  </li> -->

  <li class="nav-item">
    <a class="nav-link" href="{{ route('order.index') }}">
      <i class="fas fa-fw fa-luggage-cart"></i>
      <span>Order</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('user.index') }}">
      <i class="fas fa-fw fa-users"></i>
      <span>User</span></a>
  </li>
  @endif
  @if(auth()->user()->role_id != 1)

  <li class="nav-item">
    <a class="nav-link" href="{{ route('order.create') }}">
      <i class="fas fa-fw fa-luggage-cart"></i>
      <span>Add Order</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('order.index') }}">
      <i class="fas fa-fw fa-luggage-cart"></i>
      <span>Orders</span></a>
  </li>
  @endif

  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    User
  </div>
  <!-- Nav Item - Utilities Collapse Menu -->

  @if(auth()->user()->role_id == 1)
  <li class="nav-item">
    <a class="nav-link" href="{{ url('admin/setting/1/edit') }}">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Setting</span></a>
  </li>

  @endif


  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-sign-out-alt fa-chart-area"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->