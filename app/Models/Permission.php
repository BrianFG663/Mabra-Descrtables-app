<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Permission extends Model
{
    protected $fillable = [
        'permission',
    ];

    public function users(){
    return $this->hasMany(User::class);
    }
}
