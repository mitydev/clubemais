<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationGroup extends Model
{
    protected $fillable = ['name','slug'];
    public function destinations() {
        return $this->hasMany(Destination::class);
    }
}
