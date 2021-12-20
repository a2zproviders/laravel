<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Model\Order;
use App\Model\Setting;
use App\Model\Export;
use App\User;
use Image;
use PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role_id == 1) {
            $query  = Order::latest()->with('user');
            if ($request->search && $request->search != '') {
                $query->where('party', 'like', '%' . $request->search . '%')
                    ->orWhere('vehicle_number', 'like', '%' . $request->search . '%')
                    ->orWhere('destination', 'like', '%' . $request->search . '%');
            }
            $lists = $query->paginate(10);
        } else {
            $query  = Order::latest()->with('user')->where('user_id', Auth::user()->id);
            if ($request->search && $request->search != '') {
                $query->where('party', 'like', '%' . $request->search . '%')
                    ->orWhere('vehicle_number', 'like', '%' . $request->search . '%')
                    ->orWhere('destination', 'like', '%' . $request->search . '%');
            }
            $lists = $query->paginate(10);
        }
        $users = User::where('role_id', 2)->get();

        $userArr  = ['' => 'Select User'];
        if (!$users->isEmpty()) {
            foreach ($users as $mcat) {
                $userArr[$mcat->id] = $mcat->name;
            }
        }

        $page  = 'order.list';
        $title = 'Order list';
        $setting = Setting::find(1);
        $data  = compact('lists', 'page', 'title', 'setting', 'request', 'userArr');
        return view('admin.layout', $data);
    }

    public function create()
    {
        $page  = 'order.add';
        $title = 'Add Order';

        $data  = compact('page', 'title');
        return view('admin.layout', $data);
    }

    public function store(Request $request)
    {
        $maxInvoice     = Order::max('invoice_no');
        $invocieNo      = $maxInvoice + 1;

        $input = $request->except('_token');

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $path = public_path() . '/attechment/order';
            if (!file_exists($path)) {
                mkdir($path, 0775, true);
            }

            $filename = time() . $file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $file->move($path, $filename);

            $input['file'] = $filename;
        }

        $obj = new Order($input);
        $obj->invoice_no = $invocieNo;
        $obj->user_id = Auth::user()->id;
        $obj->vehicle_number = strtoupper($obj->vehicle_number);
        $obj->brokage = $obj->received_amount - $obj->paid_amount;
        $obj->save();

        // $order = Order::where('id', $obj->id)->with('user')->first();
        // $user = User::find($obj->user_id);
        // $setting = Setting::find(1);
        // $subject = 'Your Order has been received successfully.';

        // Mail::send('email.inquery', ['setting' => $setting, 'user' => $user, 'subject' => $subject, 'inquery' => $order], function ($message) use ($user, $setting, $subject) {
        //     $message->to($user->email);
        //     $message->subject($subject);
        //     $message->from(env('MAIL_USERNAME'), $setting->title);
        // });

        // $data = [
        //     'status' => true
        // ];

        // return response()->json($data);

        return redirect(route('order.index'))->with('success', 'Success! New record has been added.');
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order, Request $request)
    {
        $edit = $order;
        $request->replace($edit->toArray());
        $request->flash();
        $page  = 'order.edit';
        $title = 'Order Edit';

        $data  = compact('page', 'title', 'edit', 'request');
        return view('admin.layout', $data);
    }

    public function update(Request $request, Order $order)
    {
        $input = $request->except('_token');
        $order->fill($input);
        $order->user_id = Auth::user()->id;
        $order->vehicle_number = strtoupper($order->vehicle_number);
        $order->brokage = $order->received_amount - $order->paid_amount;
        $order->update();

        return redirect(url('admin/order'))->with('success', 'Success! Record has been updated.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        Order::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }

    public function change_status(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([$request->field => $request->status]);

        return redirect()->back()->with('success', "{$request->field} status has been changed.");
    }

    public function invoicepdf(Request $request, $id)
    {
        $list = Order::where('id', $id)->with('user')->first();

        $price = $list->price;
        $gst_price = ($price * 18) / 100;
        $total_price = $price + $gst_price;

        $inword_price = Order::convert_number_to_words($total_price);

        $setting = Setting::find(1);
        $logo_url = 'public/images/setting/logo/' . $setting->logo;
        $pdf = PDF::loadView('admin.inc.order.invoice', compact('list', 'setting', 'logo_url', 'price', 'gst_price', 'inword_price', 'total_price'));
        return $pdf->stream('invoice.pdf');
    }

    public function search(Request $request)
    {
        if (Auth::user()->role_id == 1) {
            $query  = Order::latest()->with('user');
            if ($request->search && $request->search != '') {
                $query->where('party', 'like', '%' . $request->search . '%')
                    ->orWhere('vehicle_number', 'like', '%' . $request->search . '%')
                    ->orWhere('destination', 'like', '%' . $request->search . '%');
            }
            if ($request->user_id && $request->user_id != '') {
                $query->where('user_id', $request->user_id);
            }
            if ($request->date && $request->date != '') {
                $query->whereDate('created_at',  $request->date);
            }
            if ($request->limit) {
                $lists = $query->paginate($request->limit);
            } else {
                $lists = $query->paginate(10);
            }
        } else {
            $query  = Order::latest()->with('user')->where('user_id', Auth::user()->id);
            if ($request->search && $request->search != '') {
                $query->where('party', 'like', '%' . $request->search . '%')
                    ->orWhere('vehicle_number', 'like', '%' . $request->search . '%')
                    ->orWhere('destination', 'like', '%' . $request->search . '%');
            }
            if ($request->date && $request->date != '') {
                $query->whereDate('created_at',  $request->date);
            }
            $lists = $query->where('user_id', Auth::user()->id)->paginate(10);
            
            if ($request->limit) {
                $lists = $query->where('user_id', Auth::user()->id)->paginate($request->limit);
            } else {
                $lists = $query->where('user_id', Auth::user()->id)->paginate(10);
            }
        }

        $setting = Setting::find(1);
        $html = view('admin.template.order', compact('lists', 'setting'))->render();

        $data = [
            'status' => true,
            'data' => $html
        ];
        return response()->json($data);
    }
    public function export(Request $request)
    {
        return Excel::download(new Export($request), 'reports.xlsx');
    }
}
