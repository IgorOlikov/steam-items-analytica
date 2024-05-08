<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = ['id','parent_id','name','slug'];

    protected $table = 'categories';

    protected $hidden = [
      'created_at', 'updated_at'
    ];

    public function childs(): HasMany
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class,'parent_id','id')
            ->with('categories')
            ->join('images','categories.id','=','images.imageable_id')
            ->select('categories.*','images.url as image');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // Get all of the tags for the category.
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'category_id', 'id');
    }

    public function attributes(): HasOne
    {
        return $this->hasOne(Attribute::class, 'category_id',  'id');
    }

    public function productFilter(): HasOne
    {
        return $this->hasOne(Filter::class, 'category_id', 'id');
    }


}
