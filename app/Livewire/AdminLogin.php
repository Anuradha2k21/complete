<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
            $user = Auth::user();
            if ($user->user_type === 'admin') {
                session()->flash('message', 'You have successfully logged in!');
                return redirect()->route('employees.index');
            } else {
                Auth::logout();
                session()->flash('error', 'Access denied. Only admins can log in.');
            }
        } else {
            session()->flash('error', 'Invalid credentials!');
        }
    }

    public function render()
    {
        return view('livewire.admin-login');
    }
}
