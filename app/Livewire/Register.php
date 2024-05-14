<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Title('Register Page')]
class Register extends Component
{
    #[Validate('required|string|min:3|max:250')]
    public $name;

    #[Validate('required|string|min:3|max:250|unique:employees,username')]
    public $username;

    #[Validate('required|email|max:250|unique:employees,email')]
    public $email;

    #[Validate('required|string|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    public function register()
    {
        $this->validate();

        Employee::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'leave_count' => rand(2, 5),
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        Auth::attempt($credentials);

        session()->flash('message', 'You have successfully registered & logged in!');

        return $this->redirectRoute('dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.register');
    }
}