<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'config';

    protected $fillable = [        
        'logo',
        'sitename',
        'company_module',
        'people_module',
        'scheduling_module',
        'contact_module',
        'URL_frontpage',
        'dateofdeath'       
    ];
}
