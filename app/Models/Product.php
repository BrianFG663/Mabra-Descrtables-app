<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
    ];

    public function sales_details(){

        return $this->hasMany(Sale_detail::class);

    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
