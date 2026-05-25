<?php

namespace App\Imports;

use App\Models\User;
use App\Traits\UserRules;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Maatwebsite\Excel\Concerns\WithValidation; 
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure; 


class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{

    use UserRules, SkipsFailures;


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user= new User([
            'name'=> $row['nome_completo'],
            'role'=> $row['privilegio']?? 'Operador',
            'password'=> Hash::make('dme'),
            'must_change_password' => true,
        ]);

        $user->contact()->update([
            'email'=> $row['email'],
            'phone'=> $row['telemovel'],
        ]);
        
        return $user;
    }

    public function rules(): array
    {
        $fieldRules = $this->getUserRules(); 

        unset($fieldRules['password']);
        unset($fieldRules['current_password']);
        unset($fieldRules['password_confirmation']);

        return [
            'nome_completo'=> $fieldRules['name'],
            'privilegio'=>['nullable', 'in:Operador,Administrador'],
            'email'=> $fieldRules['email'],
            'telemovel'=> ['nullable', 'phone', Rule::unique('contacts', 'phone')],
        ];
    }


}
