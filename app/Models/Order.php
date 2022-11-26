<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'city',
        'phone'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
