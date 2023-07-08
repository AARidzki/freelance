<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // protected $table = 'orders';
    protected $guarded = ['id'];

    public function details() 
    {
        return $this->hasMany(Detail::class);
    }

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }
}
