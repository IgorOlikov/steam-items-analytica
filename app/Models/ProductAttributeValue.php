<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id','name','values','product_attribute_id'];

    protected $table = 'product_attribute_values';
}
