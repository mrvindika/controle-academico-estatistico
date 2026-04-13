<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Traits\AppendTrait;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    use AppendTrait;
    public ?User $user= null;
    #[Validate] public string $name= '';
    #[Validate] public string $role= '';
    #[Validate] public string $email= '';
    #[Validate] public ?string $phone= null;
    #[Validate] public string $password= '';
    #[Validate] public string $password_confirmation= '';
    #[Validate] public string $current_password= '';
    #[Validate] public bool $remember = false;

    protected function rules()
    {
        return [
            'name'  => ['filled', 'string', 'max:160', 'min:2'],
            'role'  => ['required', 'in:Operador,Administrador'],
            'email' => ['filled', 'string', 'email', 'max:200', Rule::unique('users')->ignore($this->user?->id)],
            'phone' => ['nullable', 'numeric', 'digits:9', Rule::unique('users')->ignore($this->user?->id)],
            'password' => ['required', 'string','confirmed','min:8'],
            'current_password' => ['required', 'current_password'],
            'password_confirmation' => ['required'],
            'remember' => ['boolean'],
        ];
    }

    public function setUser(User $user)
    {
        $this->user= $user;
        $this->name= $user->name;
        $this->role= $user->role;
        $this->email= $user->email;
        $this->phone= $user->phone;
    }
}
