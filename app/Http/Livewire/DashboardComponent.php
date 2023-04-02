<?php

namespace App\Http\Livewire;

use App\Models\OrderDetail;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardComponent extends Component
{
    use WithPagination;

    public $searchItem, $order_detail_id;

    public function setOrderDetailId($id)
    {
        $this->order_detail_id = $id;

        $this->dispatchBrowserEvent('show-confirm-payment');
    }

    public function confirmPayment()
    {
        $order_detail = OrderDetail::find($this->order_detail_id);
        $order_detail->is_paid = 1;
        $order_detail->payment_dt = Carbon::now()->format('Y-m-d');
        $order_detail->save();

        session()->flash('message', 'Receipt generated & payment confirm');

        // Close modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $order_details = OrderDetail::with(['order', 'order.customer'])
                ->where('is_paid', 0)
                ->whereMonth('expected_dt', '<=', Carbon::now()->format('m'))
                ->whereYear('expected_dt', '<=', Carbon::now()->format('Y'))->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.dashboard-component', ['order_details' => $order_details, 'current_date' =>$current_date])->layout('livewire.layout.master');
    }
}
