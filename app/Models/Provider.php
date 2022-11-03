<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperProvider
 */
class Provider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'email', 'phone', 'paymentinfo'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
