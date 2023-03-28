<?php

namespace App\Http\Livewire;

use App\Models\Stock as ModelsStock;
use Livewire\Component;

class Stock extends Component
{
    public $title, $quantity, $per_quantity_price, $stock_edit_id;

    public function saveStock()
    {
        $this->validate([
            'title' => 'required',
            'quantity' => 'required|numeric',
            'per_quantity_price' => 'required|numeric'
        ]);

        $stock = New ModelsStock();
        $stock->title = $this->title;
        $stock->quantity = $this->quantity;
        $stock->per_quantity_price = $this->per_quantity_price;
        $stock->save();

        $this->resetForm();

        session()->flash('message', 'New stock has been added successfully');

        // Close modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editStockModel($id)
    {
        $stock = ModelsStock::find($id);
        $this->title = $stock->title;
        $this->per_quantity_price = $stock->per_quantity_price;
        $this->quantity = $stock->quantity;
        $this->stock_edit_id = $stock->id;
    }

    public function updateStock()
    {
        $this->validate([
            'title' => 'required',
            'quantity' => 'required|numeric',
            'per_quantity_price' => 'required|numeric'
        ]);

        $stock = ModelsStock::find($this->stock_edit_id);
        $stock->title = $this->title;
        $stock->quantity = $this->quantity;
        $stock->per_quantity_price = $this->per_quantity_price;
        $stock->save();

        $this->resetForm();

        session()->flash('message', 'Stock has been updated successfully');

        // Close modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->per_quantity_price = '';
        $this->quantity = '';
        $this->stock_edit_id = '';
    }

    public function render()
    {
        $stock = ModelsStock::orderBy('id', 'DESC')->get();
        return view('livewire.stock', ['stock' => $stock])->layout('livewire.layout.master');
    }
}
