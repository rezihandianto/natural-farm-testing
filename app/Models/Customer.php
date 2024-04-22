<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'photo', 'email', 'phone_number', 'gender', 'birth_date'
    ];

    public function customer_addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id', 'id');
    }
}
