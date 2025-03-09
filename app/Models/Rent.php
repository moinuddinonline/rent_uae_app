<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = 'rents';

    protected $fillable = [
        'user_id',
        'rent_vendor_id',
        'amount',
        'payment_title',
        'payment_date',
        'payment_status',
        'payment_image',
    ];

    /**
     * Get the user that owns the Rent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rent vendor that owns the Rent.
     */
    public function vendor()
    {
        return $this->belongsTo(RentVendor::class, 'rent_vendor_id', 'id');
    }

    
}
