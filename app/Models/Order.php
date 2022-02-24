<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table ='orders';
    protected $fillable = [
        'user_id',
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'order_status',
        'order_note',
        'order_total',
        'order_discount',
        'order_payment',
        'order_ship',
        'order_tracking',
        'order_description',
    ];

    public function paymentMethods()
    {
        return $this->belongsTo(PaymentMethod::class, 'order_payment');
    }
}
