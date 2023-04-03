<?php

namespace App\Http\Livewire;

use App\DataTables\CustomerDataTable;
use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerComponent extends Component
{
    use WithPagination;

    public $searchItem;

    public $name, $mobile_number, $pan, $aadhar, $customer_edit_id, $mobile_number2, $mobile_number3;

    public $dataTable;

    public function storeCustomerData()
    {
        $this->validate([
            'name' => 'required',
            'mobile_number' => 'required|digits:10|unique:customers',
            'mobile_number2' => 'sometimes',
            'mobile_number3' => 'sometimes'
        ]);

        $customer = New Customer();
        $customer->name = $this->name;
        $customer->mobile_number = $this->mobile_number;
        $customer->mobile_number2 = $this->mobile_number2;
        $customer->mobile_number3 = $this->mobile_number3;

        $customer->save();

        $this->resetForm();

        session()->flash('message', 'New Customer has been added successfully');

        //Activity Log
        activity()->withProperties($customer)->causedBy(auth()->user())->log('Create a new customer.');

        // Close modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editCustomerData()
    {
        $this->validate([
            'name' => 'required',
            'mobile_number' => 'required|digits:10|unique:customers,mobile_number,'.$this->customer_edit_id,
            'mobile_number2' => 'sometimes',
            'mobile_number3' => 'sometimes'
        ]);

        $customer = Customer::find($this->customer_edit_id);

        $customer->name = $this->name;
        $customer->mobile_number = $this->mobile_number;
        $customer->mobile_number2 = $this->mobile_number2;
        $customer->mobile_number3 = $this->mobile_number3;

        $customer->save();

        $this->resetForm();

        session()->flash('message', 'Customer has been updated successfully');

        activity()->withProperties($customer)->causedBy(auth()->user())->log('Update a customer.');

        // Close modal
        $this->dispatchBrowserEvent('close-edit-modal');

    }

    public function editCustomer($id)
    {
        $customer = Customer::find($id);
        $this->customer_edit_id = $id;
        $this->name = $customer->name;
        $this->mobile_number = $customer->mobile_number;
        $this->mobile_number2 = $customer->mobile_number2;
        $this->mobile_number3 = $customer->mobile_number3;
        // $this->pan = $customer->pan;
        // $this->aadhar = $customer->aadhar;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->mobile_number = '';
        $this->mobile_number2 = '';
        $this->mobile_number3 = '';
        $this->pan = '';
        $this->aadhar = '';
        $this->customer_edit_id = '';
    }

    public function render()
    {
        // return $dataTable->render('livewire.customer-component')->layout('livewire.layout.master');
        $customer = Customer::where(function($sub_query){
            $sub_query->where('name', 'like', '%'.$this->searchItem.'%')
                      ->orWhere('mobile_number', 'like', '%'.$this->searchItem.'%');
        })->orderBy('id', 'DESC')->paginate(10);

        return view('livewire.customer-component', ['customers' => $customer])->layout('livewire.layout.master');
    }
}
