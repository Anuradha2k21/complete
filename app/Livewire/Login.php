<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

#[Title('Login Page')]
class Login extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type === 'employee') {
                session()->flash('message', 'You have successfully logged in!');
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                session()->flash('error', 'Access denied. Only employees can log in.');
            }
        } else {
            session()->flash('error', 'Invalid credentials!');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}