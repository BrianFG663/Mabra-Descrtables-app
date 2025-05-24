<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale_detail extends Model
{

     use HasFactory;
     
    public $timestamps = false;
    protected $fillable = [
        'sales_id',
        'product_id',
        'cantidad',
        'precio_unitario',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class,'sales_id');
    }
}
