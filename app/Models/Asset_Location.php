<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset_Location extends Model
{
    protected $table = "asset_location";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
