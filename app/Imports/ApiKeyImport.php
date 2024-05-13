<?php

namespace App\Imports;

use App\Models\ApiKey;
use App\Services\ApiService;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ApiKeyImport implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return (new ApiService)->store([
            'name' => $row['name'],
            'email' => $row['email'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:api_keys'],
        ];
    }
}
