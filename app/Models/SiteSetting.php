<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['group','data'];
    protected $casts = ['data' => 'array'];
    public $timestamps = true;

    public static function footer(): ?array
    {
        return Cache::rememberForever('site_setting:footer', function () {
            return optional(self::where('group', 'footer')->first())->data;
        });
    }

    public static function navbar(): ?array
    {
        return Cache::rememberForever('site_setting:navbar', function () {
            return optional(self::where('group', 'navbar')->first())->data;
        });
    }
}
