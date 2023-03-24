<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Livewire\Component;

class OrderComponent extends Component
{
    public $customer_id, $title, $total_month, $total_amount, $loan_payment_date, $per_month_amount, $note;

    public $order_delete_id;

    public $category_type = 'Mobile';

    public $view_order_detail;

    // public $customer = [];

    public function storeOrder()
    {
        $this->validate([
            'customer_id' => 'required',
            'category_type' => 'required',
            'title' => 'required',
            'total_month' => 'required',
            'total_amount' => 'required',
            'per_month_amount' => 'required',
            'loan_payment_date' => 'required',
            'note' => 'sometimes'
        ]);

        $date = Carbon::parse($this->loan_payment_date)->format('Y-m-d');

        $order = new Order();
        $order->customer_id = $this->customer_id;
        $order->title = $this->title;
        $order->total_month = $this->total_month;
        $order->total_amount = $this->total_amount;
        $order->per_month_amount = $this->per_month_amount;
        $order->note = $this->note;
        $order->loan_payment_date = $this->loan_payment_date;
        $order->save();



        for($i=1; $i<=$order->total_month; $i++)
        {

            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->expected_dt = $date;
            $order_detail->amount = $this->per_month_amount;
            $order_detail->save();
            $date = Carbon::parse(strtotime($date))->addMonth()->format('Y-m-d');

        }

        $this->resetForm();

        session()->flash('message', 'New order has been created');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetForm()
    {
        $this->customer_id = '';
        $this->title = '';
        $this->total_month = '';
        $this->total_amount = '';
        $this->per_month_amount = '';
        $this->note = '';
    }

    public function deleteConfirmation($id){
        $this->order_delete_id = $id;

        $this->dispatchBrowserEvent('show-order-delete-model');
    }

    public function deleteOrder()
    {
        $order = Order::find($this->order_delete_id);
        $order->delete();
        $this->order_delete_id = '';
        session()->flash('message', 'Order has been removed');

        $this->dispatchBrowserEvent('close-delete-model');
    }

    public function orderWithDetail($id)
    {
        $order = Order::with(['customer', 'order_details'])->where('id', '=', $id)->first();

        $this->view_order_detail = $order;

        $this->dispatchBrowserEvent('show-order-detail');
    }

    public function calculateLoan()
    {
        $this->per_month_amount = round(($this->total_amount / $this->total_month), 2);
    }

    public function render()
    {
        $customer = Customer::all();
        $orders =Order::with(['customer'])->orderBy('id', 'DESC')->get();
        // dd($orders[0]->customer);
        return view('livewire.order-component', ['customer' => $customer, 'orders' => $orders])->layout('livewire.layout.master');
    }

    public function printLoanInvoice()
    {
        $this->dispatchBrowserEvent('print-order');
    }
}
