<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWarrantyPolicy extends Model
{
    use HasFactory;

    protected $table = 'product_warranty_policies';

    protected $fillable = [
        'product_id', 'warranty_policy_id'
    ];

    public $timestamps = false;
}
