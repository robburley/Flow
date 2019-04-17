<?php

namespace App\Models;

use App\Models\Prospect\Callback;
use App\Models\Prospect\Prospect;
use App\Models\Prospect\Review;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'active',
        'deactivated_at',
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

    public function prospects()
    {
        return $this->hasMany(Prospect::class, 'created_by');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function callbacks()
    {
        return $this->hasMany(Callback::class, 'user_id');
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            return $this->attributes['password'] = bcrypt($value);
        }
    }

    public function getRoleNamesAttribute()
    {
        $roles = $this->getRoleNames();

        return !$roles->isEmpty()
            ? $roles->implode(', ')
            : 'No Roles Set';
    }

    public function setActiveAttribute($value)
    {
        return $this->attributes['deactivated_at'] = !$value
            ? Carbon::now()
            : null;
    }

    public function getActiveAttribute()
    {
        return $this->deactivated_at
            ? 0
            : 1;
    }
}
