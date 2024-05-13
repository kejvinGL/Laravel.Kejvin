<?php

namespace App\Exports;

use App\Models\ApiKey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApiKeyExport implements FromCollection, WithMapping, withHeadings, ShouldAutoSize, WithStyles, WithDefaultStyles, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ApiKey::all();
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->email,
            $row->value,
            Date::dateTimeToExcel($row->created_at),
            Date::dateTimeToExcel($row->updated_at),

        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Value', 'Created At', 'Updated At'];
    }

    public function styles(Worksheet $sheet)
    {
        $start = 'A1';
        $end = 'E' . count($this->collection()) + 1;

        $sheet->getStyle($start . ':' . $end)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '141414'],
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['argb' => '4b4b4b'],
                ],
                'vertical' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '4b4b4b']
                ]
            ],
        ]);

        return [
            1 => ['font' => ['bold' => true],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_THICK,
                        'color' => ['argb' => '4b4b4b']
                    ],
                ]
            ],
        ];
    }

    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'borders' => [
                '' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000']
                ]
            ],
            'font' => [
                'color' => ['argb' => 'ffffff'], // White color
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
    }
}
