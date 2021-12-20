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
          <!-- Page Heading -->
          <div class="row">
            <div class="col-xs-12 col-lg-12">
              <div class="card" style="margin-bottom: 20px;">
                <div class="card-body">
                  {{ Form::open(['method' => 'GET','url' => url(route('order.export'))]) }}
                  <div class="row">
                    <div class="col-3">
                      <input type="text" id="order_search" data-url="{{ route('order.search') }}" value="{{ $request->search }}" name="search" class="form-control" placeholder="Search...." />
                    </div>
                    @if(auth()->user()->role_id == 1)
                    <div class="col-3">
                      {{Form::select('user_id', $userArr,'0', ['class' => 'form-control', 'id'=>'order_user_id'])}}
                    </div>
                    @endif
                    <div class="col-3">
                      {{Form::date('date', '', ['class' => 'form-control', 'placeholder'=>'Date', 'id'=>'order_date'])}}
                    </div>
                    @php
                    $limitArr = [
                      10 => 10,
                      25 => 25,
                      50 => 50,
                      100 => 100,
                      500 => 500,
                      ];

                    @endphp
                    <div class="col-1">
                      {{Form::select('limit', $limitArr,'0', ['class' => 'form-control', 'id'=>'order_limit'])}}
                    </div>
                    <div class="col-2">
                      <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                  </div>
                  {{ Form::close() }}
                </div>
              </div>
              <div id="order_lists">
                @include('admin.template.order', compact('lists','setting'))
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