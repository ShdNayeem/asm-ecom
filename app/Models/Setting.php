<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'website_name',
        'website_url',
        'page_title',

        'address',
        'phone1',
        'phone2',
        'email1',
        'email2',

        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];
}
