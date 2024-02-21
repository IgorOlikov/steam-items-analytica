<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id','name','values','product_id','attribute_id'];

    protected $table = 'attribute_values';
}
