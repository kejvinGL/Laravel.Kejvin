<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ApiKey extends Model
{
    use HasFactory;


    protected $fillable =[
        'name',
        'email',
        'value',
    ];

}
