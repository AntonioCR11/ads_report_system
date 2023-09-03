<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Reporter extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'identity_type',
        'identity_number',
        'pob',
        'dob',
        'address',
    ];
}
