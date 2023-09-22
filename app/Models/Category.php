<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'parent_id',
        'description',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
