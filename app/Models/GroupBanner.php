<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupBanner extends Model
{
    protected $table = 'group_banners';

    protected $fillable = ['name', 'slug'];

    public function banners()
    {
        return $this->hasMany(Banner::class, 'group_banner_id')
            ->orderBy('position')
            ->orderBy('id');
    }

    // Opcional: se quiser usar o slug nas rotas (Route Model Binding)
    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }
}
