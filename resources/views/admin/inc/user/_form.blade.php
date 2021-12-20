@if($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">x</button>
  {{$message}}
</div>
@endif
@if(count($errors->all()))
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="row">
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('name', 'Enter Name')}}
      {{Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'Enter name','id'=>'name','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('mobile', 'Enter Mobile')}}
      {{Form::text('mobile', '', ['class' => 'form-control', 'placeholder'=>'Enter mobile','id'=>'mobile','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('email', 'Enter Email')}}
      {{Form::email('email', '', ['class' => 'form-control', 'placeholder'=>'Enter email','id'=>'email'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('password', 'Enter Password')}}
      @if(@$edit['id'])
      {{Form::text('password', '', ['class' => 'form-control', 'placeholder'=>'Enter password','id'=>'password'])}}
      @else
      {{Form::text('password', '', ['class' => 'form-control', 'placeholder'=>'Enter password','id'=>'password','required'=>'required'])}}
      @endif
    </div>
  </div>
  <!-- <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('city_id', 'Select City')}}
      {{Form::select('city_id', $cityArr,'0', ['class' => 'form-control', 'id'=>'city_id'])}}
    </div>
  </div> -->
</div>