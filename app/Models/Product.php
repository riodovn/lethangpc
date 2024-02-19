<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price','description','category_id', 'discount_price','status'
    ];

    public function technicalSpecs()
    {
        return $this->hasMany(TechnicalSpec::class,);
    }

    public function warrantyPolicies()
    {
        return $this->belongsToMany(WarrantyPolicy::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
