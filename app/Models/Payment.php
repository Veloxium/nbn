<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PaymentsProduct;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'postal_code',
        'address',
        'amount',
        'status',
        'payment_method',
        'delivery_status',
        'no_resi',
        'proof_of_payment',
        'paid_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PaymentsProduct::class);
    }
}
