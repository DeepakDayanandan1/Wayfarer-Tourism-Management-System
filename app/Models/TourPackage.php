<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    protected $table = 'tbltourpackages';
    protected $primaryKey = 'PackageId';
    public $timestamps = true;

    const CREATED_AT = 'Creationdate';
    const UPDATED_AT = 'UpdationDate';

    protected $fillable = [
        'PackageName',
        'PackageType',
        'PackageLocation',
        'PackagePrice',
        'PackageFetures',
        'PackageDetails',
        'PackageImage',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'PackageId', 'PackageId');
    }

    public function getImageUrlAttribute()
    {
        if ($this->PackageImage && file_exists(public_path('packageimages/' . $this->PackageImage))) {
            return asset('packageimages/' . $this->PackageImage);
        }
        if ($this->PackageImage && file_exists(public_path('admin/pacakgeimages/' . $this->PackageImage))) {
            return asset('admin/pacakgeimages/' . $this->PackageImage);
        }
        return asset('images/3333333.jpg');
    }
}

