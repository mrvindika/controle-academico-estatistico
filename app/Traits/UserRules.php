<?php

namespace App\Traits;

use Illuminate\Validation\Rule;

trait UserRules
{
    /**
    * Return All Validation Rules for User
    * @return  array
    */
    public function getUserRules():array
    {
        $userId = isset($this->user->id)? $this->user->id : null;

        return [
            'name'  => ['bail','filled', 'string', 'max:160', 'min:2'],
            'role'  => ['bail', 'required', 'in:Operador,Administrador'],
            'email' => ['bail','filled', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'phone' => ['bail','nullable', 'numeric', 'digits:9', Rule::unique('users')->ignore($userId)],
            'password' => ['bail', 'required', 'string','confirmed','min:6'],
            'current_password' => ['bail','required', 'current_password'],
            'password_confirmation' => ['required'],
            'remember' => ['boolean'],
        ];
    }




}

