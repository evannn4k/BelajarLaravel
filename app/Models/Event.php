<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function registration()
    {
        return $this->hasMany(Registration::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryEvent::class);
    }
}
