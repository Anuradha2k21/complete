<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

#[Title('Admin Login Page')]
class AdminLogin extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    public function admin_login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            session()->flash('message', 'You have successfully logged in!');

            return redirect()->route('employees.index');
        }

        session()->flash('error', 'Invalid credentials!');
    }
    public function render()
    {
        return view('livewire.admin-login');
    }
}