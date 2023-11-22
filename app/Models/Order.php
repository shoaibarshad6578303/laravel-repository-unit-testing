<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['client', 'details', 'is_fulfilled']; 

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = strtolower($value);
    }

    public function getClientAttribute($value)
    {
        return strtoupper($value);
    }
}
