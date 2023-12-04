<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $fillable = [
        'name',
        'path',
        'size',
        'type'
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'image_id', 'id');
    }
}
