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
        <div class="container-fluid">
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">General Setting</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <!-- {{ Form::open(['url' => url(env('ADMIN_DIR').'/setting/edit/1'), 'method'=>'POST','files' => true, 'class' => 'user']) }} -->
                  {!! Form::open(['method' => 'PUT', 'route'=>array('setting.update', 1), 'class' => 'user','files'=>true]) !!}
                  @include('admin.inc.setting._form')
                  <div class="text-right">
                    <input type="submit" class="btn btn-primary" value="Save" />
                  </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->