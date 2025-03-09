<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentVendor extends Model
{
    protected $table = 'rent_vendors';

    protected $fillable = [
        'user_id',
        'rent_type_id',
        'vendor_name',
        'email',
        'mobile',
        'iban_number',
    ];

    /**
     * Get the user that owns the RentVendor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rent type that owns the RentVendor.
     */
    public function rentType()
    {
        return $this->belongsTo(RentType::class);
    }
}
