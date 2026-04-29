<?php

namespace App\Exports;

use App\Traits\AppendTrait;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class FailedModelExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    use AppendTrait;
    protected $failures;
    protected array $fields;

    public function __construct(array $failures, array $fields)
    {
        $this->failures = $failures;
        $this->fields= $this->rename($fields);
        array_push($this->fields, 'erro (a corrigir)');
    }

    public function array(): array
    {
        return $this->failures;
    }
    
    public function headings(): array
    {
        return $this->fields;
    }
    
    public function styles(Worksheet $sheet)
    {
        $lastRow = count($this->failures) + 1;
        $lastColumn= $this->letter(count($this->fields) -1);

        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => Color::COLOR_WHITE],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '002060'],
                ],
            ],

            "{$lastColumn}1" => [
                'font' => ['bold' => true, 'color' => ['argb' => Color::COLOR_WHITE]],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '990000'],
                ],
            ],

            "{$lastColumn}2:{$lastColumn}{$lastRow}" => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFFF00'], 
                ],
                'font' => [
                    'italic' => true,
                ],
            ],
        ];
    }
}
