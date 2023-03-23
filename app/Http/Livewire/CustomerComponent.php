<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerComponent extends Component
{
    public $name, $mobile_number, $pan, $aadhar, $customer_edit_id;


    public function storeCustomerData()
    {
        $this->validate([
            'name' => 'required',
            'mobile_number' => 'required|digits:10|unique:customers',
            'pan' => 'required|alpha_num',
            'aadhar' => 'required|digits:16'
        ]);

        $customer = New Customer();
        $customer->name = $this->name;
        $customer->mobile_number = $this->mobile_number;
        $customer->pan = $this->pan;
        $customer->aadhar = $this->aadhar;

        $customer->save();

        $this->resetForm();

        session()->flash('message', 'New Customer has been added successfully');

        // Close modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editCustomerData()
    {
        $this->validate([
            'name' => 'required',
            'mobile_number' => 'required|digits:10|unique:customers,mobile_number,'.$this->customer_edit_id,
            'pan' => 'required|alpha_num',
            'aadhar' => 'required|digits:16'
        ]);

        $customer = Customer::find($this->customer_edit_id);

        $customer->name = $this->name;
        $customer->mobile_number = $this->mobile_number;
        $customer->pan = $this->pan;
        $customer->aadhar = $this->aadhar;

        $customer->save();

        $this->resetForm();

        session()->flash('message', 'Customer has been updated successfully');

        // Close modal
        $this->dispatchBrowserEvent('close-edit-modal');

    }

    public function editCustomer($id)
    {
        $customer = Customer::find($id);
        $this->customer_edit_id = $id;
        $this->name = $customer->name;
        $this->mobile_number = $customer->mobile_number;
        $this->pan = $customer->pan;
        $this->aadhar = $customer->aadhar;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->mobile_number = '';
        $this->pan = '';
        $this->aadhar = '';
        $this->customer_edit_id = '';
    }

    public function render()
    {
        $customer = Customer::all();
        return view('livewire.customer-component', ['customers' => $customer])->layout('livewire.layout.master');
    }
}
