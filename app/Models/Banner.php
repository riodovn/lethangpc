<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'title', 'description', 'image_id'
    ];

    public $timestamps = true;

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id');
    }
}
