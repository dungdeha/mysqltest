<?php

namespace App\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'address'
    ];

    /**
     * @return CustomerFactory
     */
    protected static function newFactory() {
        return CustomerFactory::new();
    }
}
