<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSoldProduct
 */
class SoldProduct extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'price', 'qty', 'total_amount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
