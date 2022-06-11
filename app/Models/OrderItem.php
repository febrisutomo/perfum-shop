<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;

    protected $appends = ['ammount'];

    public function getAmmountAttribute()
    {
        return $this->attributes['price'] * $this->attributes['qty'];
    }
}
