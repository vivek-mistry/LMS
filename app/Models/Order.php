<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table_name = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'category_type',
        'title',
        'total_month',
        'total_amount',
        'per_month_amount',
        'loan_payment_date',
        'note'
    ];

    /**
     * Undocumented function
     *
     * @return BelongsTo
     */
    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * order detail relation load
     *
     * @return HasMany
     */
    public function order_details() : HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
