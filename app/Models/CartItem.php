<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CartItem extends Model
{
    use HasFactory;
        //HasUuids;

    protected $table = 'cart_items';
    protected $fillable = [
        'cart_id',
        'product_id',
        //'price',
        'quantity'];

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';


    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class,'cart_id','id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }


    public function image(): HasOne
    {
        return $this->hasOne(Image::class,'imageable_id','product_id')
            ->orderBy('created_at','desc');
    }

}
