<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTransfer
 */
class Transfer extends Model
{
    protected $fillable = [
        'title', 'sended_amount', 'received_amount', 'sender_method_id', 'receiver_method_id', 'reference'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function sender_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'sender_method_id');
    }

    public function receiver_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'receiver_method_id');
    }
}
