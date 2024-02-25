<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTechnicalSpec extends Model
{
    use HasFactory;

    protected $table = 'product_technical_specifications';

    protected $fillable = [
        'product_id', 'technical_specification_id'
    ];

    public $timestamps = false;
}
