<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profiles';

    protected $fillable = [
        'company_name',
        'tax_number',
        'address',
        'phone',
        'email',
        'logo_path',
    ];
}
