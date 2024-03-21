<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tags';

    protected $fillable = ['id','name'];



    // Get all of the products that are assigned this tag.
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }


    // Get all of the categories that are assigned this tag.
    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'taggable');
    }

}
