<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'fecha',
        'total',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sales_details(){

        return $this->hasMany(Sale_detail::class);

    }
}
