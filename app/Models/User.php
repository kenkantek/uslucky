<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'avatar', 'email', 'password',
    ];

    protected $appends = ['image'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'avatar',
    ];

    public function getImageAttribute()
    {
        return asset($this->avatar);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
