<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'summary',
        'description',
        'ingredients',
        'cost_price',
        'price',
        'stock',
        'images',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array'
    ];

    protected $appends = [
        'thumbnail'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withTimestamps()
            ->withPivot('price', 'qty');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getThumbnailAttribute()
    {
        if ($this->images[0]!= null){
            return $this->images[0]['path'];
        }

        return 'default.jpg';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        })->when($filters['brand'] ?? null, function ($query, $brand) {
            $query->whereHas('brand', function ($query) use ($brand) {
                $query->where('slug', $brand);
            });
        });

    }
}
