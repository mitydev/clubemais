<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name','slug'];
    public function locals() { return $this->hasMany(Local::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
