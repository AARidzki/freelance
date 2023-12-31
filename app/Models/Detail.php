<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    // protected $table = ['details'];
    protected $guarded = ['id'];

    public function orders() 
    {
        return $this->belongsTo(Order::class);
    }
}
