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
          <!-- Content Row -->
          @if (\Session::has('success'))
              <div class="alert alert-success toast-msg" style="color: green">
                  {!! \Session::get('success') !!}</li>
              </div>
          @endif

          @if (\Session::has('danger'))
              <div class="alert alert-danger toast-msg" style="color: red;">
                  {!! \Session::get('danger') !!}</li>
              </div>
          @endif
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
              <button class="btn btn-primary" data-toggle="collapse" data-target="#cat_box">+ Add</button>
                </div>

                 <!-- Card Body -->
                <div class="card-body collapse" id="cat_box">
                {!! Form::open(['method' => 'POST', 'action' => 'admin\CategoryController@store', 'class' => 'user', 'files'=>'true']) !!}
                      @include('admin.template._category_form')
                  <div class="text-right">
                    <input type="submit"class="btn btn-primary" value="Add Category"/>
                  </div>
                {!! Form::close() !!}
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-lg-12">
          {{ Form::open(['url' => url(env('ADMIN_DIR').'/category/'),'files' => true]) }}
              <div class="card">
                <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                  <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-url="{{ url(env('ADMIN_DIR').'/category/delete') }}" id="delete_all">Delete</button>
                </div>
                <div class="card-body">
                 <table class="table table-bordered">
                   <thead class="thead-dark">
                     <tr>
                       <th>S No.</th>
                       <th>Image</th>
                       <th>Category</th>
                       <th>Parent</th>
                       <!-- <th>State Name</th> -->
                       <!-- <th>Action</th> -->
                     </tr>
                   </thead>
                   <tbody>
                    @php
                    $sn = $lists->firstItem();
                    @endphp
                    @foreach($lists as $list)
                       <tr class="bg-light">
                        <td>{{ $sn++ }}. | 
                            @if($list->product_count == '0')
                            <input type="checkbox" name="sub_chk[]" value="{{ $list->id }}" class="sub_chk" data-id="{{$list->id}}">
                            @else
                            Is Used
                            @endif
                        </td>
                        <td>
                          @if($list->image != '')
                          <img src="{{ url('imgs/category/'.$list->image) }}" alt="{{ $list->name }}" width="50">
                          @else
                          N/A
                          @endif
                        </td>
                         <td><a href="{{route('category.edit', $list->id) }}">
                         <i class="far fa-edit" aria-hidden="true"></i>   {{$list->name}}</a></td>
                         <td>{{ $list->cat ? $list->cat->name : 'N/A' }}</td>
                        
                       </tr>
                     @endforeach
                   </tbody>
                 </table>

              {{  $lists->links() }}
                </div>

              </div>
          {{ Form::close() }}
            </div>
          </div>
         </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

  </div>
