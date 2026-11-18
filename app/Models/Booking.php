<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'tblbooking';
    protected $primaryKey = 'BookingId';
    public $timestamps = true;

    const CREATED_AT = 'RegDate';
    const UPDATED_AT = 'UpdationDate';

    protected $fillable = [
        'PackageId',
        'UserEmail',
        'FromDate',
        'ToDate',
        'Comment',
        'status',
        'CancelledBy',
    ];

    public function package()
    {
        return $this->belongsTo(TourPackage::class, 'PackageId', 'PackageId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserEmail', 'EmailId');
    }

    public function getStatusTextAttribute()
    {
        if ($this->status == 2) {
            return 'Cancelled by ' . ($this->CancelledBy == 'a' ? 'Admin' : 'You');
        }
        if ($this->status == 1) {
            return 'Confirmed';
        }
        return 'Pending';
    }

    public function getStatusBadgeClassAttribute()
    {
        if ($this->status == 1) {
            return 'success';
        }
        if ($this->status == 2) {
            return 'danger';
        }
        return 'warning text-dark';
    }
}

