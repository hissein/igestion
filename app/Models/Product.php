<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use SoftDeletes,HasFactory;

    protected $fillable = [
        "id",
        'name', 'description', 'product_category_id', 'price', 'stock', 'stock_defective','status'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id')->withTrashed();
    }

    public function solds(): HasMany
    {
        return $this->hasMany(SoldProduct::class);
    }

    public function receiveds(): HasMany
    {
        return $this->hasMany(ReceivedProduct::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
