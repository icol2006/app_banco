<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'password',  
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullName()
    {
        return  $this->name . " " . $this->lastname;
    }

    public function getRol()
    {
        $res = "";
        $roles = $this->getRoleNames();

        foreach ($roles as $item) {
            $res .= strtoupper($item) .  " ";
        }
        return  $res;
    }

    public function getAllPermissionsAttribute()
    {
        $permissions[] = array();

        foreach ($this->getAllPermissions() as $permission) {
            $permissions[] = $permission->name;
        }

        return  $permissions;
    }
}
