<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RentType extends Model
{
    protected $table = 'rent_types';

    protected $appends = ['image_url'];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'sort_order',
    ];

    public function getImageUrlAttribute()
    {
        if (($this->image !== null) && Storage::exists($this->image)) {
            return asset(Storage::url($this->image));
        } else {
            return null;
        }
    }
}
