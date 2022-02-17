<?php

namespace App\Models;

use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // public function roles(){
    //     return $this->hasMany(Role::class,'role_id');
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role_name)
    {
        // $user_roles = UserRole::where('user_id', Auth::user()->user_id)->get();
        $user_roles = auth()->user()->roleUser()->get();

        if(count($user_roles) > 0) {
            $has_role = false;
            foreach($user_roles as $user_role){
                $role_id = $user_role->role_id;
                $role = Role::find($role_id);                
                if($role != null) {        
                    $checkRoleName = $role->role_name == $role_name ? true : false;
                    if($checkRoleName) {
                        $has_role = true;
                    } 
                }
            }

            return $has_role;
        } else {
            return false;
        }
    }
   
    public function roleUser(){
        return $this->hasMany(RoleUser::class, 'user_id');
    }
    public function blogs(){
        return $this->hasMany(Blog::class, 'user_id');
    }

    public function applications(){
        return $this->hasMany(Application::class, 'app_id');
    }

    public function jobs(){
        return $this->hasMany(Job::class, 'job_id');
    }

}
