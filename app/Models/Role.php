<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // public function user(){
    //     return $this->belongsToMany('App\Models\User');
    // }

    public $primaryKey = 'role_id';

    public function roleUser(){
        return $this->hasMany(RoleUser::class, 'role_id');
    }
}
