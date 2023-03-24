<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email, $password;

    public function render()
    {
        return view('livewire.login')->layout('livewire.layout.master');
    }

    public function checkAuthenticate()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $auth = Auth::attempt(['email' => $this->email, 'password' => $this->password]);

        if($auth)
        {
            return redirect()->route('customers');
        }

        session()->flash('message', 'Invalid Credentials');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('login');
    }




}
