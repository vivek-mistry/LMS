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

    public $name, $mobile_number, $pan, $aadhar, $customer_edit_id;

    public $dataTable;

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
        // return $dataTable->render('livewire.customer-component')->layout('livewire.layout.master');
        $customer = Customer::where(function($sub_query){
            $sub_query->where('name', 'like', '%'.$this->searchItem.'%')
                      ->orWhere('mobile_number', 'like', '%'.$this->searchItem.'%');
        })->orderBy('id', 'DESC')->paginate(10);

        return view('livewire.customer-component', ['customers' => $customer])->layout('livewire.layout.master');
    }
}
