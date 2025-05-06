<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image', 'colors'];

    protected $casts = [
        'colors' => 'array',
    ];
    public function paymentItems()
    {
        return $this->hasMany(PaymentsProduct::class);
    }
}
