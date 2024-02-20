<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jsonz extends Model
{
    use HasFactory;


    protected $table = 'jsonz';
    protected $fillable = ['content'];
}
