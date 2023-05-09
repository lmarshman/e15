<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User')
            ->withTimestamps()
            ->withPivot('notes');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

}
