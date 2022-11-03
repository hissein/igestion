<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTransactionType
 */
class TransactionType extends Model
{
    protected $fillable = ['type', 'description'];
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
