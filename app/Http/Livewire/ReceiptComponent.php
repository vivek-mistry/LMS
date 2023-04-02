<?php

namespace App\Http\Livewire;

use App\Models\OrderDetail;
use Livewire\Component;
use Livewire\WithPagination;

class ReceiptComponent extends Component
{
    use WithPagination;

    public $searchItem;

    public function render()
    {
        $order_details = OrderDetail::with(['order', 'order.customer'])
                ->where('is_paid', 1)->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.receipt-component', ['order_details' => $order_details])->layout('livewire.layout.master');
    }
}
