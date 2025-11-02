<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'destination_group_id','position','title','excerpt','link_url',
        'image_path','is_active','starts_at','ends_at','meta'
    ];

    protected $casts = [
        'is_active' => 'bool',
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
        'meta'      => 'array',
    ];

    public function group() { return $this->belongsTo(DestinationGroup::class,'destination_group_id'); }
}
