<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageBanner extends Model
{
    protected $fillable = [

        'title',

        'subtitle',

        'image',

        'button_text',

        'button_link',

        'sort_order',

        'status',

    ];

    protected $casts = [

        'status' => 'boolean',

    ];
}