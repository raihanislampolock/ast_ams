<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset_Transactions extends Model
{
    protected $table = "asset_transactions";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function Modelfk()
    {
        return $this->hasOne(Asset_Model::class, 'id', 'asset_model_id');
    }
}
