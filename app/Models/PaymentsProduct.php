<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Payment;
use App\Models\Product;

class PaymentsProduct extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id', 'product_id', 'quantity', 'price', 'color', 'total'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
