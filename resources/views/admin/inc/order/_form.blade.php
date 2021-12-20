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
      {{Form::label('party', 'Party Name')}}
      {{Form::text('party', '', ['class' => 'form-control', 'placeholder'=>'Party Name','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('vehicle_number', 'Vehicle Number')}}
      {{Form::text('vehicle_number', '', ['class' => 'form-control', 'placeholder'=>'Vehicle Number','required'=>'required','style'=>'text-transform:uppercase'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('destination', 'Destination Name')}}
      {{Form::text('destination', '', ['class' => 'form-control', 'placeholder'=>'Destination Name','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('price', 'Price')}}
      {{Form::number('price', '', ['class' => 'form-control', 'placeholder'=>'Price','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('weight', 'Weight')}}
      {{Form::text('weight', '', ['class' => 'form-control', 'placeholder'=>'Weight'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('amount', 'Net Amount')}}
      {{Form::number('amount', '', ['class' => 'form-control', 'placeholder'=>'Amount'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('received_amount', 'Amount Received (from party)')}}
      {{Form::number('received_amount', '', ['class' => 'form-control', 'placeholder'=>'Amount Received','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('paid_amount', 'Amount Paid')}}
      {{Form::number('paid_amount', '', ['class' => 'form-control', 'placeholder'=>'Amount Paid','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      {{Form::label('pump', 'Pump')}}
      {{Form::text('pump', '', ['class' => 'form-control', 'placeholder'=>'Pump'])}}
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group">
      {{Form::label('remark', 'Remarks')}}
      {{Form::textarea('remark', '', ['class' => 'form-control', 'placeholder'=>'Remarks','style'=>'height: 100px'])}}
    </div>
  </div>

  <!-- <div class="col-lg-12" id="price_div" style="display: none;">
    <div style="font-weight: bold;">Payment detail :-</div>
    <div>Price : ₹ <span id="inquery_price"></span></div>
    <div>GST Price (18%) : ₹ <span id="inquery_gst"></span></div>
    <div>Total Price : ₹ <span id="inquery_total_price"></span></div>
  </div>
  <input type="hidden" name="txn_id" id="paymentID">
  <input type="hidden" name="price" id="order_price">
  <input type="hidden" name="gst_price" id="order_gst_price">
  <input type="hidden" name="total_price" id="order_total_price">
  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
  <div style="opacity: 0;" data-url="{{ url('/') }}" id="base_url"></div> -->

  </div>