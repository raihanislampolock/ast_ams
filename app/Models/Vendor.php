<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = "vendor";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}