<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id','attributes','product_category_id','product_id'];

    protected $table = 'product_attributes';
}
