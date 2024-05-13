<?php

namespace App\Imports;

use App\Services\UserService;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{

//    private $rowCount = 2;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
//        $this->rowCount++;
        return (new UserService)->store([
            'username' => $row['username'],
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => $row['password'],
            'role' => $row['role_id'],
        ]);
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->withoutTrashed()],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->withoutTrashed()],
            'password' => ['required', 'min:8'],
        ];
    }

//    public function customValidationMessages(): array
//    {
//        return [
//            'username.unique' => 'The :attribute in row '. $this->rowCount .' has already been taken.',
//        ];
//    }

}
