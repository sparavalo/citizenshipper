<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_date',
        'pickup_location',
        'delivery_date',
        'delivery_location',
        'description',
        'estimated_value',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function catAttributes()
    {
        return $this->hasOne(CategoryAttributes::class);
    }
}
