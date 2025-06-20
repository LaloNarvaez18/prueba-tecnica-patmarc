<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'description',
        'expiration_date'
    ];

    protected $with = ['categories'];
    protected $cats = [
        'expiration_date' => 'datetime'
    ];

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function setExpirationDateAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['expiration_date'] = null;
        } else {
            $this->attributes['expiration_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
        }
    }
}
