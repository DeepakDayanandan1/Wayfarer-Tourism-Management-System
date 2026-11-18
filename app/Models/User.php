<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tblusers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    const CREATED_AT = 'RegDate';
    const UPDATED_AT = 'UpdationDate';

    protected $fillable = [
        'FullName',
        'MobileNumber',
        'EmailId',
        'Password',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getRememberTokenName()
    {
        return '';
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'UserEmail', 'EmailId');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'UserEmail', 'EmailId');
    }
}

