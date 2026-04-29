<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Traits\AppendTrait;
use App\Traits\UserRules;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    use AppendTrait;
    use UserRules;
    public ?User $user= null;
    #[Validate] public string $name= '';
    #[Validate] public string $role= '';
    #[Validate] public string $email= '';
    #[Validate] public ?string $phone= null;
    #[Validate] public string $password= '';
    #[Validate] public string $password_confirmation= '';
    #[Validate] public string $current_password= '';
    #[Validate] public bool $remember = false;

    public function setUser(User $user)
    {
        $this->user= $user;
        $this->name= $user->name;
        $this->role= $user->role;
        $this->email= $user->email;
        $this->phone= $user->phone;
    }

    
    public function rules(): array
    {
        return $this->getUserRules();
    }
}
