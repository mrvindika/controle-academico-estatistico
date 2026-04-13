<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait AppendTrait
{

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




}

