<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Find a user by account activation details
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param  string
     * @param  string
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeByActivationDetails(Builder $query, $email, $token)
    {
        return $query->where('activation_token', $token)
            ->where('email', $email);
    }

    /**
     * Query scope to find a user by email address
     * @param  Illuminate\Database\Eloquent\Builder
     * @param  string $email
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEmail(Builder $query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Query scope to return only inactive users
     * @param  Illuminate\Database\Eloquent\Builder
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive(Builder $query)
    {
        return $query->where('active', false);
    }

    /**
     * Activate the current user
     */
    public function activate()
    {
        return tap($this)->update([
            'active' => true,
            'activation_token' => null
        ]);
    }
}
