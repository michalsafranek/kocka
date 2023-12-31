<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuMeal extends Model
{
    use HasFactory;
    protected $fillable = ['restaurant','year', 'week'];
}
