<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupBannersModel extends Model
{
    protected $table = "group_banners";
    protected $guarded = [];

    public function banners()
    {
        return $this->hasMany(BannersModel::class, 'group_banner_id');
    }
}
