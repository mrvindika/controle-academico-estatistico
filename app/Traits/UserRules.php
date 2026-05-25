<?php

namespace App\Traits;

use App\Models\Contact;
use Illuminate\Validation\Rule;

trait UserRules
{
    /**
    * Return All Validation Rules for User
    * @return  array
    */
    public function getUserRules():array
    {
        $contactId= isset($this->user)? $this->user->contact->id: null;
        
        return [
            'name'  => ['filled', 'string', 'max:160', 'min:2'],
            'role'  => [ 'in:Operador,Administrador'],
            'phone' => ['nullable', 'phone', Rule::unique('contacts')->ignore($contactId)],
            'email' => ['required_without:phone','nullable', 'email', 'max:255', Rule::unique('contacts')->ignore($contactId)],
            'password' => [ 'required', 'string','confirmed','min:4'],
            'current_password' => ['required', 'current_password'],
            'password_confirmation' => ['required'],
            'remember' => ['boolean'],
        ];
    }


}

