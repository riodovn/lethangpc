<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name', 'price','description','category_id', 'discount_price','status'
    ];

    public function technicalSpecs()
    {
        return $this->belongsToMany(TechnicalSpec::class, 'product_technical_specifications', 'product_id', 'technical_specification_id');
    }

    public function warrantyPolicies()
    {
        return $this->belongsToMany(WarrantyPolicy::class, 'product_warranty_policies', 'product_id', 'warranty_policy_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'product_promotions', 'product_id', 'promotion_id');
    }
}
