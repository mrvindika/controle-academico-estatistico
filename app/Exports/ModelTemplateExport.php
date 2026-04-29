<?php

namespace App\Exports;

use App\Traits\AppendTrait;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
class ModelTemplateExport implements WithHeadings, WithStyles, ShouldAutoSize
{
    use AppendTrait;

    protected array $fields;
    public function __construct(array $fields)
    {
       $this->fields= $this->rename($fields);
    }
    
    public function headings(): array
    {
        return $this->fields;
    }


    public function styles(Worksheet $sheet): array
    {
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
        ];
    }
}

