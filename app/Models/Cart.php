<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Cart extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'carts';

    protected $fillable = [
        //'id',
        'user_id',
        'status'
    ];

    protected $guarded = ['id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }

    public function cartItemsWithPrice(): HasMany
    {
        return $this->hasMany(CartItem::class,'cart_id','id')
            ->join('products','cart_items.product_id','=','products.id'); // select
    }


}
