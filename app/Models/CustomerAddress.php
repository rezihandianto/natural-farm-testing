<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $table = 'customer_addresses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id', 'recipient_name', 'name_address', 'detail_address', 'phone_number', 'zip_code'
    ];
}
