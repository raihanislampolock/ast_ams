<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = "asset";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function AssetTypefk()
    {
        return $this->hasOne(Asset_Type::class, 'id', 'asset_type_id');
    }

    public function AssetModelfk()
    {
        return $this->hasOne(Asset_Model::class, 'id', 'asset_model_id');
    }
    
    public function AssetLocationfk()
    {
        return $this->hasOne(Asset_Location::class, 'id', 'asset_location_id');
    }

    public function Vendorfk()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    public function AssetTransactionsfk()
    {
        return $this->hasOne(Asset_Transactions::class, 'id', 'asset_transactions_id');
    }

    public function Manufacturerfk()
    {
        return $this->hasOne(Manufacturer::class, 'id', 'manufacturer_id');
    }
}
