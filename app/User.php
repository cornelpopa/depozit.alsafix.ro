<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name',
                            'email',
                            'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password',
                          'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ 'email_verified_at' => 'datetime',
    ];


    public function getGravatarAttribute()
    {
        $hash = md5( strtolower( trim( $this->attributes[ 'email' ] ) ) );

        return "http://www.gravatar.com/avatar/$hash";
    }

    public function isAdmin()
    {
        foreach ( $this->roles as $role ) {
            if ( $role->role == 'admin' ) {
                return true;
            }
        }

        return false;
    }

    public function roles()
    {
        return $this->hasMany( Role::class );
    }

    public function receptions()
    {
        $this->hasMany( Reception::class );
    }

    public function inventories()
    {
        $this->hasMany( Inventory::class );
    }
}
