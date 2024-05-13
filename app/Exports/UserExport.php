<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithDefaultStyles
{
    public function collection()
    {
        return User::withTrashed()->with('avatar')->withCount(['posts', 'comments'])->get();
    }

    public function map($row): array
    {
        return [
            $row->username,
            $row->name,
            $row->email,
            $row->role_id,
            $row->deleted_at,
            $row->avatar->path ?? null,
            $row->posts_count,
            $row->comments_count,
        ];
    }

    public function headings(): array
    {
        return ['Username', 'Name', 'Email', 'Role Id', 'Deleted At', 'Avatar', 'Post Count', 'Comment Count'];
    }

    public function styles(Worksheet $sheet)
    {
        $start = 'A1';
        $end = 'H' . count($this->collection()) + 1;

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
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '2b2b2b'],
                ],
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
