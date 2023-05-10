<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset_Type extends Model
{
    protected $table = "asset_type";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
