<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedOrders extends Component
{
    use WithPagination;

    public $searchItem, $order_id;

    public function openConfirm($order_id)
    {
        $this->order_id = $order_id;

        $this->dispatchBrowserEvent('show-model');
    }

    public function recoverOrder()
    {
        Order::withTrashed()->find($this->order_id)->restore();

        session()->flash('message', 'Your order has been restored');

        $this->dispatchBrowserEvent('close-model');
    }

    public function render()
    {
        $orders = Order::with(['customer'])->where(function($sub_query){
            $sub_query->where('title', 'like', '%'.$this->searchItem.'%');
        })->orderBy('id', 'DESC')->onlyTrashed()->paginate(10);
        return view('livewire.trashed-orders', ['orders' => $orders])->layout('livewire.layout.master');
    }
}
