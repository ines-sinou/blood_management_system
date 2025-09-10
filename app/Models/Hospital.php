<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Hospital extends Model
{
    protected $fillable = [
        'name', 'region', 'membership_id', 'membership_start', 'membership_end'
    ];

    public function memberships() {
        return $this->belongsTo(Membership::class);
    }

public function admin()
{
    return $this->hasOne(User::class)->whereHas('role', function($query) {
        $query->where('name', 'hospital_admin');
    });
}


public function staff()
{
    $staffRoleIds = Role::whereIn('name', ['labtech', 'hospital_staff'])->pluck('id');
    return $this->hasMany(User::class)->whereIn('role_id', $staffRoleIds);
}

}

