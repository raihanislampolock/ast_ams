<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department_Name extends Model
{
    protected $table = "department_name";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
