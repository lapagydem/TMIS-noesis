<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_desc',
        'region_id',
        'district_id',
        'code',
        'logo',
        'status',
        'created_by'
    ];
}
