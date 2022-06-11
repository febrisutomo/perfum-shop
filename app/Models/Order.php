<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'shipping',
        'courier',
        'payment',
    ];

    protected $casts = [
        'shipping' => 'json',
    ];

    protected $appends = ['ammount'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items')
            ->using(OrderItem::class)
            ->withTimestamps()
            ->withPivot('price', 'qty')
            ->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAmmountAttribute()
    {
        return $this->items->sum('pivot.ammount');
    }

    public function getDateAttribute()
    {
        return date('d M Y', strtotime($this->created_at));
    }

    public function getTimeAttribute()
    {
        return date('H:i', strtotime($this->created_at));
    }

    public function getInvoiceAttribute()
    {
        return "INV/".date('Ymdis', strtotime($this->created_at))."/".str_pad($this->id, 5, "0", STR_PAD_LEFT);
    }

    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['status'] ?? false, function ($query, $status) {
            return $query->where('status', $status);
        });
    }
}
