<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = ['name', 'price', 'duration_months'];

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
    }
}

