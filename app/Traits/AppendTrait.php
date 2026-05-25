<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

trait AppendTrait
{

    /**
    * Returns phone 
    * @param string $string
    * @return  string
    */
    public static function phone(string $string)
    {
        // Remove all characters different of digits and +.
        $phone= preg_replace('/[^0-9+]/','', $string);

        return $phone;
    }

        /**
    * Returns phone 
    * @param string $string
    * @return  bool
    */
    public static function phoneNumber(string $string)
    {
        return (bool) preg_match('/^\+?[0-9]+$/', $string);
    }

    /**
    * Returns phone number without country code
    * @param string $string
    * @return  string
    */
    public static function remove244(string $string)
    {
        // Remove all characters different of digits and +.
        $phone= preg_replace('/^\+?244/','', $string);

        return $phone;
    }

    /**
    * Delete any file from specific filePath
    * @param string $filePath
    * @return  void
    */
    public static function delFile(string $filePath)
    {
        if(preg_match('/Windows/', php_uname())) 
            $filePath= preg_replace("/\//", "\\", $filePath); 
        if(is_file($filePath)) 
            unlink($filePath);
    }

    /**
    * Determine if the role is invalid or not
    * @param string $role
    * @return  bool
    */
    public static function invalidRole(string $role)
    {
        return !collect(['Operador', 'Administrador'])->contains($role);
    }

    /**
    * Returns the Valid path according the OS platform
    * @param string $filePath
    */
    public static function validPath(mixed $filePath)
    {
        if(preg_match('/Windows/', php_uname())) 
            $filePath= preg_replace("/\//", "\\", $filePath);
        return $filePath;
    }


    /**
    * Get 'Fullname' value sliced from 'pessoa' Attribute
    * @return string
    */
    public static function fullName($name){
        $name= strtolower($name);
        $name= ucwords($name);
        $arrayName= explode(' ', $name);
        $size= count($arrayName);
        $firstName= $arrayName[0];
        $middleNames= '';
        $lastName= '';
        if($size>1) $lastName= ' '.$arrayName[$size-1];
        if($size>2)
            for($i=1; $i<($size -1); $i++){ 
                $middleNames.= ' '.$arrayName[$i][0].'.';
            }
        return $firstName.$middleNames.$lastName;
    }

    /**
    * Get 'Fullname' value sliced from 'pessoa' Attribute
    * @return string
    */
    public static function firstName($name){
        $arrayName= explode(' ', self::fullName($name));
        
        return $arrayName[0];
    }

    /**
    * Get 'Fullname' value sliced from 'pessoa' Attribute
    * @return string
    */
    public static function lastName($name){
        $arrayName= explode(' ', self::fullName($name));

        return $arrayName[count($arrayName)-1];
    }

    /**
     * Validate only fields present on given array.
     */
    public function validateOnlyFields(array $fieldNames): array
    {
        $validatedData= [];

        foreach ($fieldNames as $field) {
            $this->validateOnly($field);
            $validatedData[$field] = $this->$field;
        }

        $exclude = ['password_confirmation', 'current_password', 'terms', 'remember'];
        $filtered = array_diff_key($validatedData, array_flip($exclude));

        if (isset($filtered['password']) && !empty($filtered['password'])) {
            $filtered['password'] = Hash::make($filtered['password']);
        }

        return $filtered;
    }

    /**
    * Check weather given route name is last page user had visited
    * @return bool
    */
    public static function isLastRoute(string $routeName){
        
        return Route::getRoutes()->match(request()->create(url()->previous()))->getName() === $routeName;
    }

    /**
    * Check weather given route name is last page user had visited
    * @return array
    */
    public static function rename(array $names):array
    {
        $result= [];
        foreach ($names as $name)
           array_push($result, preg_replace('/_/', ' ', $name));
        
        return $result;
    }

    /**
     * Returns  array of customized attributes
     * @return string
    */
    public static function letter(int $index){

        $result= [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K','L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        ];

        return $result[$index];

    }

    /**
     * Returns  array of customized attributes
     * @return mixed
    */
    public function importModel (object $importModel) 
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls,csv']);

        $import = new $importModel;
        Excel::import($import, $this->file);
        $failed = $import->failures()->count();

        if($failed > 0) {
            $failuresData= $import->failures()->map(function ($failure) {
                $value = $failure->values();
                $data= [];

                foreach ($this->fields as $field) array_push($data, ($value[$field]?? ''));

                array_push($data, implode(', ', $failure->errors()));
                
                return $data;
            })->toArray();

            $this->file = null;

            return ['data'=>$failuresData, 'failures'=> $failed];
        }

        $this->file = null;
        $this->importModal= false;

        return null;
    }

    /**
     * Returns  array of customized attributes
     * @return void
    */
    public function importMessage (string $modelName= 'registro', int $failures=0) 
    {
        if($failures > 0){
            $this->dispatch('swal:alert', 
                icon: 'warning',
                title: 'Importado(s) com erro(s)!',
                message: "Corrija os erros de $failures $modelName(s) no ficheiro gerado.",
            );
        }
        else{
            $this->dispatch('swal:alert', 
                icon: 'success',
                title: 'Sucesso!',
                text: "Todos $modelName(s) importado(s) com sucesso.",
            );
        }
    }







}

