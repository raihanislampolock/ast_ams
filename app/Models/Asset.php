<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = "asset";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
