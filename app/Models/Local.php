<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = ['name','slug','description','term_id'];
    public function term() { return $this->belongsTo(Term::class); }
    public function getRouteKeyName(): string { return 'slug'; }
}
