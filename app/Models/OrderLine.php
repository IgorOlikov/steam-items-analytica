<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderLine extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'order_lines';

    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        //'price',
        'quantity'];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

}
