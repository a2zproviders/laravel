<?php

namespace App\Model;

use App\Model\Order;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use stdClass;

class Export implements FromCollection, WithHeadings
{
    protected $request;

    function __construct($request)
    {
        $this->request = $request;
    }

    public function headings(): array
    {
        return ["User Name", "User Mobile", "Party", "Vehicle Number", "Destination", "Price", "Weight", "Amount", "Received Amount", "Paid Amount", "Brokage", "Pump", "Remark", "Date"];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth::user()->role_id == 1) {
            $query  = Order::latest()->with('user');
            if ($this->request->search && $this->request->search != '') {
                $query->where('party', 'like', '%' . $this->request->search . '%')
                    ->orWhere('vehicle_number', 'like', '%' . $this->request->search . '%')
                    ->orWhere('destination', 'like', '%' . $this->request->search . '%');
            }
            if ($this->request->user_id && $this->request->user_id != '') {
                $query->where('user_id', $this->request->user_id);
            }
            if ($this->request->date && $this->request->date != '') {
                $query->whereDate('created_at',  $this->request->date);
            }
            if ($this->request->limit) {
                $lists = $query->paginate($this->request->limit);
            } else {
                $lists = $query->paginate(10);
            }
            // dd($lists);
        } else {
            $query  = Order::latest()->with('user')->where('user_id', Auth::user()->id);
            if ($this->request->search && $this->request->search != '') {
                $query->where('party', 'like', '%' . $this->request->search . '%')
                    ->orWhere('vehicle_number', 'like', '%' . $this->request->search . '%')
                    ->orWhere('destination', 'like', '%' . $this->request->search . '%');
            }
            if ($this->request->date && $this->request->date != '') {
                $query->whereDate('created_at',  $this->request->date);
            }

            if ($this->request->limit) {
                $lists = $query->where('user_id', Auth::user()->id)->paginate($this->request->limit);
            } else {
                $lists = $query->where('user_id', Auth::user()->id)->paginate(10);
            }
        }
        // $list = Report::select('id','title','slug','keyword','meta_title','amr_id','category_id','pages','single_user','corporate_user','report_summery','table_content')->get();

        $total_amount = 0;
        $total_received_amount = 0;
        $total_paid_amount = 0;
        $brokage = 0;
        $pump = 0;

        foreach ($lists as $l) {
            $total_amount += $l->amount;
            $total_received_amount += $l->received_amount;
            $total_paid_amount += $l->paid_amount;
            $brokage += $l->brokage;
            $pump += $l->pump;

            $l->user_name = $l->user->name;
            $l->user_mobile = $l->user->mobile;
            $l->party1 = $l->party;
            $l->vehicle_number1 = $l->vehicle_number;
            $l->destination1 = $l->destination;
            $l->price1 = $l->price;
            $l->weight1 = $l->weight;
            $l->amount1 = $l->amount;
            $l->received_amount1 = $l->received_amount;
            $l->paid_amount1 = $l->paid_amount;
            $l->brokage1 = $l->brokage;
            $l->pump1 = $l->pump;
            $l->remark1 = $l->remark;
            $l->date = date('d F, Y', strtotime($l->created_at));
            unset($l->id);
            unset($l->invoice_no);
            unset($l->user_id);
            unset($l->party);
            unset($l->vehicle_number);
            unset($l->destination);
            unset($l->price);
            unset($l->weight);
            unset($l->amount);
            unset($l->received_amount);
            unset($l->paid_amount);
            unset($l->brokage);
            unset($l->pump);
            unset($l->remark);
            unset($l->txn_id);
            unset($l->status);
            unset($l->updated_at);
            unset($l->created_at);
            // $l->url = route('report_url', $l->id);
        }
        $j = new Order();
        $j->user_name = '';
        $j->user_mobile = '';
        $j->party1 = '';
        $j->vehicle_number1 = '';
        $j->destination1 = '';
        $j->price1 = '';
        $j->weight1 = '';
        $j->amount1 = '';
        $j->received_amount1 = '';
        $j->paid_amount1 = '';
        $j->brokage1 = '';
        $j->pump1 = '';
        $j->remark1 = '';
        $j->date = '';

        $lists[$lists->count()] = $j;

        $k = new Order();
        $k->user_name = '';
        $k->user_mobile = '';
        $k->party1 = 'Total';
        $k->vehicle_number1 = '';
        $k->destination1 = '';
        $k->price1 = '';
        $k->weight1 = '';
        $k->amount1 = $total_amount;
        $k->received_amount1 = $total_received_amount;
        $k->paid_amount1 = $total_paid_amount;
        $k->brokage1 = $brokage;
        $k->pump1 = $pump;
        $k->remark1 = '';
        $k->date = '';

        $lists[$lists->count() + 1] = $k;
        // dd($lists);
        // array_push($lists, [' ', 'Items Count:', '=COUNTA(C2:C3)', ' ', 'Profit Sum:', '=SUM(D2:D3)']);

        return $lists;
    }
}
