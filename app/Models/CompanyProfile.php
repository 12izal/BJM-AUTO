<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [

        'company_name',

        'slogan',

        'logo',

        'banner',

        'tentang',

        'alamat',

        'telepon',

        'email',

        'facebook',

        'instagram',

        'tiktok',

        'youtube',

        'whatsapp',

        'google_maps',

        'jam_senin_jumat',

        'jam_sabtu',

        'jam_minggu'

    ];
}