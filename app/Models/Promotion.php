<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $fillable = [
        'title', 'description'
    ];

    public $timestamps = true;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
