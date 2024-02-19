<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyPolicy extends Model
{
    use HasFactory;
    protected $table = 'warranty_policies';

    protected $fillable = [
        'title',
        'content',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
