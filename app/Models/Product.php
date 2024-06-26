<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory,HasUuids, Filterable;

    protected $casts = [
        'price' => 'float',
        'id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

   protected $keyType = 'string';

   protected $fillable = ['id','category_id','name','price','slug'];

    protected $table = 'products';


    public function attributes(): HasOne
    {
        return $this->hasOne(AttributeValue::class, 'product_id','id');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class,'imageable')
            ->orderBy('created_at','desc');

    }


    public function scopeOldestImage(Builder $builder): Builder
    {
        //return $builder->orderBy('created_at','asc')->limit(1);
        return $builder->join('images','products.id','=','images.imageable_id');
    }


    //  Get all of the tags for the product.
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }


}
