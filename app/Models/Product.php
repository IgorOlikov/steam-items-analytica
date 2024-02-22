<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = ['id','category_id','name','price'];

    protected $table = 'products';


    public function attributeValue(): HasOne
    {
        return $this->hasOne(AttributeValue::class, 'product_id','id');
    }


    public function scopeBrand(Builder $query, $brand): Builder
    {
        return  $query->where('values->brand',$brand);
    }

    public function scopeType(Builder $query, $type): Builder
    {
        return  $query->where('values->type',$type);
    }

    public function scopePriceBetween(Builder $query, $priceFrom,$priceTo): Builder
    {
        return $query->whereBetween('price', [$priceFrom,$priceTo]);
    }

    public function scopeName(Builder $query, $name): Builder
    {
        return $query->where('name','like', "%$name%");
    }

    public function scopeCores(Builder $query, $cores): Builder
    {
        return $query->whereBetween('values->cores', $cores);
    }



}
