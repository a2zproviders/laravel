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
      {{Form::label('title', 'Title')}}
      {{Form::text('title', '', ['class' => 'form-control', 'placeholder'=>'Enter Title','id'=>'title','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('tagline', 'Tagline')}}
      {{Form::text('tagline', '', ['class' => 'form-control', 'placeholder'=>'Enter Tagline','id'=>'tagline','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('email', 'Email')}}
      {{Form::email('email', '', ['class' => 'form-control', 'placeholder'=>'Enter Email','id'=>'email','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('mobile', 'Mobile No.')}}
      {{Form::number('mobile', '', ['class' => 'form-control', 'placeholder'=>'Enter Mobile No.','id'=>'mobile','required'=>'required'])}}
    </div>
  </div>
  <!-- <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('phone', 'Phone No.')}}
      {{Form::number('phone', '', ['class' => 'form-control', 'placeholder'=>'Enter Phone No.','id'=>'phone'])}}
    </div>
  </div> -->
  <!-- <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('gst', 'GST No.')}}
      {{Form::text('gst', '', ['class' => 'form-control', 'placeholder'=>'Enter GST No.','id'=>'gst'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('invoice_pre', 'Invoice Prefix')}}
      {{Form::text('invoice_pre', '', ['class' => 'form-control', 'placeholder'=>'Enter Invoice Prefix','id'=>'invoice_pre'])}}
    </div>
  </div> -->
  <!-- <div class="col-lg-3">
    <div class="form-group">
      {{Form::label('logo', 'Select Logo')}}
      {{Form::file('logo', ['class' => 'form-control', 'placeholder'=>'Enter Logo'])}}
    </div>
  </div>
  <div class="col-lg-3">
    @if($edit->logo)
    <img src="{{ url('imgs/logo/'.$edit->logo) }}" alt="" title="{{ $edit->logo }}" width="100px">
    @endif
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      {{Form::label('favicon', 'Select Favicon')}}
      {{Form::file('favicon', ['class' => 'form-control', 'placeholder'=>'Enter Favicon'])}}
    </div>
  </div>
  <div class="col-lg-3">
    @if($edit->favicon)
    <img src="{{ url('imgs/favicon/'.$edit->favicon) }}" alt="" title="{{ $edit->favicon }}" width="100px">
    @endif
  </div> -->
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('address', 'Address')}}
      {{Form::textarea('address', '', ['class' => 'form-control', 'placeholder'=>'Enter Address','id'=>'mobile','required'=>'required','style'=>'height: 100px'])}}
    </div>
  </div>
  <!-- <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('google_map', 'Map Link')}}
      {{Form::textarea('google_map', '', ['class' => 'form-control', 'placeholder'=>'Enter Map Link','id'=>'mobile','required'=>'required','style'=>'height: 100px'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('sms_api', 'SMS Api')}}
      {{Form::textarea('sms_api', '', ['class' => 'form-control', 'placeholder'=>'Enter SMS Api','id'=>'mobile','style'=>'height: 100px'])}}
    </div>
  </div> -->
</div>
<!-- <hr>
<div class="row">
  <div class="col-lg-4">
    <div class="form-group">
      {{Form::label('facebook', 'Facebook Link')}}
      {{Form::text('facebook', '', ['class' => 'form-control', 'placeholder'=>'Enter Facebook Link'])}}
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      {{Form::label('instagram', 'Instagram Link')}}
      {{Form::text('instagram', '', ['class' => 'form-control', 'placeholder'=>'Enter Instagram Link'])}}
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      {{Form::label('twitter', 'Twitter Link')}}
      {{Form::text('twitter', '', ['class' => 'form-control', 'placeholder'=>'Enter Twitter Link'])}}
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      {{Form::label('youtube', 'Youtube Link')}}
      {{Form::text('youtube', '', ['class' => 'form-control', 'placeholder'=>'Enter Youtube Link'])}}
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      {{Form::label('linkedin', 'Linkedin Link')}}
      {{Form::text('linkedin', '', ['class' => 'form-control', 'placeholder'=>'Enter linkedin Link'])}}
    </div>
  </div>
</div> -->