<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false; 
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'is_admin',
        'login_attemp',
        'createdAt',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function biodata()
    {
        return $this->hasMany(Biodata::class, 'id_user');
    }
    
    public function statuskep()
    {
        return $this->hasMany(StatusKep::class, 'id_user');
    }

    public function location()
    {
        return $this->hasMany(Location::class, 'id_user');
    }

    public function trackternak()
    {
        return $this->hasMany(TrackTernak::class, 'id_user');
    }
}
