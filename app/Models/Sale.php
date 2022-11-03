<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSale
 */
class Sale extends Model
{
    protected $fillable = [
        'client_id', 'user_id'
    ];
    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
    public function products() {
        return $this->hasMany(Product::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
