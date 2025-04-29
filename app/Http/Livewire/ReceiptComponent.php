<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Component;
use Livewire\WithPagination;

class ReceiptComponent extends Component
{
    use WithPagination;

    public $searchItem, $view_order_detail;

    public function orderWithDetail($id)
    {
        $order = Order::with(['customer', 'order_details'])->where('id', '=', $id)->first();

        $this->view_order_detail = $order;

        $this->dispatchBrowserEvent('show-order-detail');
    }

    public function printLoanInvoice()
    {
        $this->dispatchBrowserEvent('print-order');
    }

    public function render()
    {
        $order_details = OrderDetail::with(['order', 'order.customer'])
                ->whereHas('order.customer')
                ->where('is_paid', 1)->orderBy('payment_dt', 'DESC')->paginate(10);
        return view('livewire.receipt-component', ['order_details' => $order_details])->layout('livewire.layout.master');
    }
}
