<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FailedModelExport;

class ModelActions
{
   
    /**
     * Returns  array of customized attributes
     * @return mixed
    */
    public function importModel (object $importModel) 
    {
        $this->validate(['file' => 'required|mimes:xlsx,xls,xlsm,csv']);
        $import = new $importModel;
        Excel::import($import, $this->file);
        $failed = $import->failures()->count();
        $countImport = count(Excel::toArray($import, $this->file)[0]); 
        $succeed = $countImport - $failed;

        if($failed > 0) {
            $failuresData= $import->failures()->map(function ($failure) {
                $value = $failure->values();
                $data= [];

                foreach ($this->fields as $field)
                    array_push($data, ($value[$field]?? ''));
                array_push($data, implode(', ', $failure->errors()));
                
                return $data;
            })->toArray();

            $this->file = null;

            $this->dispatch('swal:alert', 
                icon: 'warning',
                title: 'Importação com Alertas',
                message: "Sucesso: $succeed registros salvos. \n Erros: $failed registros pendentes no ficheiro.",
            );

            return Excel::download(new FailedModelExport($failuresData, $this->fields), ('erros_' .now()->format('Ymd_His') .'.xlsx'));
        }

        $this->file = null;
        
        $this->dispatch('swal:alert', 
            icon: 'success',
            title: 'Sucesso Total!',
            text: "Todos os $succeed registros foram importados corretamente.",
        );
    }
}
