<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "department";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function Departmentfk()
    {
        return $this->hasOne(Department_Name::class, 'id', 'department_name_id');
    }

    public function Employeefk()
    {
        return $this->hasOne(Employee::class, 'id', 'hod_id');
    }
}
