<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalSpec extends Model
{
    use HasFactory;

    protected $table = 'technical_specifications';

    protected $fillable = [
        'name', 'value', 'product_id'
    ];

    public $timestamps = true;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
