<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset_Tracking extends Model
{
    protected $table = "asset_tracking";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function Departmentfk()
    {
        return $this->hasOne(Department_Name::class, 'id', 'department_id');
    }

    public function Employeefk()
    {
        return $this->hasOne(Employee::class, 'id', 'emp_id');
    }

    public function SNNumberfk()
    {
        return $this->hasOne(Asset::class, 'id', 'asset_id');
    }

}


    public function AssetLocationfk()
    {
        return $this->hasOne(Asset_Location::class, 'id', 'asset_location_id');
    }

}

