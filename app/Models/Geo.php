<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geo extends Model
{
    use HasFactory;
    protected $fillable = [
    'ip',
    'city',
    'region',
    'country',
    'loc',
    'org',
    'postal',
    'timezone',
    'user_ip',
    'user_city',
    'user_region',
    'user_country',
    'user_loc',
    'user_org',
    'user_postal',
    'user_timezone',
    
];
}
