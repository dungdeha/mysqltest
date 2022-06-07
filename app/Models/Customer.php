<?php

namespace App\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

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
    protected function newFactory() {
        return CustomerFactory::new();
    }
}
