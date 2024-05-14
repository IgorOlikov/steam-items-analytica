<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
      'attributes->screenDiagonal' => 'float'
    ];

    protected $fillable = ['id','product_id','attribute_id','attributes'];

    protected $table = 'attribute_values';
}
