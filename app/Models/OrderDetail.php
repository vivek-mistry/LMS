<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table_name = 'order_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'expected_dt',
        'payment_dt',
        'amount',
        'is_paid'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
