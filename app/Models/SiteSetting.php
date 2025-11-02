<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SiteSetting extends Model
{
    protected $fillable = ['group','data'];
    protected $casts = ['data' => 'array'];
    public $timestamps = true;

    public static function footer(): ?array {
        return static::query()->where('group','footer')->value('data');
    }
}
