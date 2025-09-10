<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donation;

class Donor extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'name',
        'email',
        'phone',
        'blood_group',
        'dob',
        'address',
        'status'
    ];

    // public function donations(){
    //     return $this->hasMany(Donation::class);
    // }
}
