<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cart_items';
    protected $fillable = ['cart_id','price','quantity'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class,'cart_id','id');
    }



}
