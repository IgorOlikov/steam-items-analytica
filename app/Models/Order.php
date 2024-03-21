<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'orders';

    protected $fillable = ['id','user_id'];


    public function user(): HasOne
    {
        return $this->hasOne(User::class,'user_id','id');
    }

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class,'order_id','id');
    }
}
