<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function order() {
        return $this->belongsToMany(Order::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
