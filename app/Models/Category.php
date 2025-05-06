<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
