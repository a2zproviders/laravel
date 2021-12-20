{{ Form::open(['url' => url(env('ADMIN_DIR').'/order')]) }}
<div class="card">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
        @if(auth()->user()->role_id == 1)
        <div>
            <!-- <a href="{{ url(env('ADMIN_DIR').'/role/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">+ Add Role</a> -->
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-url="{{ url(env('ADMIN_DIR').'/order/delete') }}" id="delete_all">Delete</button>
        </div>
        @endif
    </div>
    <div class="card-body">
        <table class="table table-bordered table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>S No.</th>
                    @if(auth()->user()->role_id == 1)
                    <th>User</th>
                    @endif
                    <th>Party</th>
                    <th>Vehicle No.</th>
                    <th>Destination</th>
                    <th>Price</th>
                    <th>Weight</th>
                    <th>Amount</th>
                    <th>Received Amount</th>
                    <th>Paid Amount</th>
                    <th>Brokage</th>
                    <th>Pump</th>
                    <th>Date</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @php
                $sn = $lists->firstItem();
                $total_amount = 0;
                $total_received_amount = 0;
                $total_paid_amount = 0;
                $brokage = 0;
                $pump = 0;
                @endphp
                @if($lists->count() != 0)
                @foreach($lists as $list)
                @if(auth()->user()->role_id == 1)
                @php
                $total_amount += $list->amount;
                $total_received_amount += $list->received_amount;
                $total_paid_amount += $list->paid_amount;
                $brokage += $list->brokage;
                $pump += $list->pump;
                @endphp
                <tr class="bg-light">
                    @if(auth()->user()->role_id == 1)
                    <td>{{ $sn++ }}. |
                        <input type="checkbox" name="sub_chk[]" value="{{ $list->id }}" class="sub_chk" data-id="{{$list->id}}">
                    </td>
                    <td>{{ $list->user->name }} ({{ $list->user->mobile }})</td>
                    @else
                    <td>{{ $sn++ }}.</td>
                    @endif
                    <td>
                        <a href="{{route('order.edit', $list->id) }}">
                            <i class="far fa-edit" aria-hidden="true"></i> {{$list->party}}
                        </a>
                    </td>
                    <!-- <td>{{ sprintf("%s/%04d", $setting->invoice_pre, $list->invoice_no) }}</td> -->
                    <td>{{ $list->vehicle_number }}</td>
                    <td>{{ $list->destination }}</td>
                    <td>₹ {{ $list->price? $list->price : 0}}</td>
                    <td>{{ $list->weight ? $list->weight : 'N/A' }}</td>
                    <td>₹ {{ $list->amount? $list->amount : 0}}</td>
                    <td>₹ {{ $list->received_amount? $list->received_amount : 0}}</td>
                    <td>₹ {{ $list->paid_amount? $list->paid_amount : 0}}</td>
                    <td>₹ {{ $list->brokage? $list->brokage : 0}}</td>
                    <td>₹ {{ $list->pump? $list->pump : 0}}</td>
                    <td>{{ date('d F, Y',strtotime($list->created_at)) }}</td>
                    <td>{{ $list->remark ? $list->remark : 'N/A' }}</td>
                    <!-- <td>
                          @php
                          $statusArr = [
                          "pending" => "Pending",
                          "processing" => "Processing",
                          "completed" => "Completed",
                          "canceled" => "Canceled",
                          ];
                          @endphp
                          {{ Form::select("order_status", $statusArr, $list->status, ["onchange" => "statuschange(this)","class"=>"form-control", "data-url" => route('order_status', $list->id)]) }}
                        </td> -->
                    <!-- <td>
                          @if($list->file)
                          <a href="{{ url('attechment/order/'.$list->file) }}" target="_blank" class="btn btn-primary"><i class="fa fa-paperclip"></i></a>
                          @else
                          N/A
                          @endif
                        </td>
                        <td>
                          <a href="{{ url('admin/inquery/pdf/'.$list->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i></a>
                        </td> -->
                </tr>
                @else
                @if($list->user_id == auth()->user()->id)
                @php
                $total_amount += $list->amount;
                $total_received_amount += $list->received_amount;
                $total_paid_amount += $list->paid_amount;
                $brokage += $list->brokage;
                $pump += $list->pump;
                @endphp
                <tr class="bg-light">
                    @if(auth()->user()->role_id == 1)
                    <td>{{ $sn++ }}. |
                        <input type="checkbox" name="sub_chk[]" value="{{ $list->id }}" class="sub_chk" data-id="{{$list->id}}">
                    </td>
                    <td>{{ $list->user->name }} ({{ $list->user->mobile }})</td>
                    @else
                    <td>{{ $sn++ }}.</td>
                    @endif
                    <td>
                        <a href="{{route('order.edit', $list->id) }}">
                            <i class="far fa-edit" aria-hidden="true"></i> {{$list->party}}
                        </a>
                    </td>
                    <!-- <td>{{ sprintf("%s/%04d", $setting->invoice_pre, $list->invoice_no) }}</td> -->
                    <td>{{ $list->vehicle_number }}</td>
                    <td>{{ $list->destination }}</td>
                    <td>₹ {{ $list->price? $list->price : 0}}</td>
                    <td>{{ $list->weight ? $list->weight : 'N/A' }}</td>
                    <td>₹ {{ $list->amount? $list->amount : 0}}</td>
                    <td>₹ {{ $list->received_amount? $list->received_amount : 0}}</td>
                    <td>₹ {{ $list->paid_amount? $list->paid_amount : 0}}</td>
                    <td>₹ {{ $list->brokage? $list->brokage : 0}}</td>
                    <td>₹ {{ $list->pump? $list->pump : 0}}</td>
                    <td>{{ date('d F, Y',strtotime($list->created_at)) }}</td>
                    <td>{{ $list->remark ? $list->remark : 'N/A' }}</td>
                    <!-- <td>
                          @php
                          $statusArr = [
                          "pending" => "Pending",
                          "processing" => "Processing",
                          "completed" => "Completed",
                          "canceled" => "Canceled",
                          ];
                          @endphp
                          {{ Form::select("order_status", $statusArr, $list->status, ["onchange" => "statuschange(this)","class"=>"form-control", "data-url" => route('order_status', $list->id)]) }}
                        </td> -->
                    <!-- <td>
                          @if($list->file)
                          <a href="{{ url('attechment/order/'.$list->file) }}" target="_blank" class="btn btn-primary"><i class="fa fa-paperclip"></i></a>
                          @else
                          N/A
                          @endif
                        </td>
                        <td>
                          <a href="{{ url('admin/inquery/pdf/'.$list->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i></a>
                        </td> -->
                </tr>
                @endif
                @endif
                @endforeach
                <tr>
                    @if(auth()->user()->role_id == 1)
                    <th colspan="7" style="text-align: center;">Total</th>
                    @else
                    <th colspan="6" style="text-align: center;">Total</th>
                    @endif
                    <th>₹ {{ $total_amount }}</th>
                    <th>₹ {{ $total_received_amount }}</th>
                    <th>₹ {{ $total_paid_amount }}</th>
                    <th>₹ {{ $brokage }}</th>
                    <th>₹ {{ $pump }}</th>
                    <th colspan="2"></th>
                </tr>
                @else
                <tr class="bg-light">

                    @if(auth()->user()->role_id == 1)
                    <td colspan="14">
                        <div style="text-align: center;">No record found.</div>
                    </td>
                    @else
                    <td colspan="13">
                        <div style="text-align: center;">No record found.</div>
                    </td>
                    @endif
                </tr>
                @endif
            </tbody>
        </table>

        {{ $lists->links() }}
    </div>

</div>
{{ Form::close() }}