<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    @include('admin.common.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        @include('admin.common.TopHeader')

        <!-- Begin Page Content -->
        <div class="container-fluid" style="min-height: 81vh;">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">
            @if(auth()->user()->role_id == 1)

            <div class="col-xl-3 col-md-6 mb-4">
              <a href="{{ route('user.index') }}" style="text-decoration: none;">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total no. of User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <a href="{{ route('order.index') }}" style="text-decoration: none;">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total no. of Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-luggage-cart fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            @else
            
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="{{ route('order.index') }}" style="text-decoration: none;">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total no. of Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-luggage-cart fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            @endif
          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        @php
        $setting = App\Model\Setting::find(1);
        @endphp
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; {{ $setting->title }} 2021</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <script>
      $(document).ready(function() {
        $('#remove-swiper').on('click', function(e) {


        })
      })
    </script>
    <!-- End of Page Wrapper -->