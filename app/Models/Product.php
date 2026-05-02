<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image',
        'category'
    ];

    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            return null;
        }

        $path = trim($this->image, " '\\");

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $path = preg_replace('#^storage/#', '', $path);
        $path = preg_replace('#^public/#', '', $path);
        $path = preg_replace('#^storage/app/public/#', '', $path);
        $path = ltrim($path, '/');

        $segments = array_map('rawurlencode', explode('/', $path));
        $path = implode('/', $segments);

        return asset('storage/' . $path);
    }
}