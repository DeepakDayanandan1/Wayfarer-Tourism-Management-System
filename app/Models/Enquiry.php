<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'tblenquiry';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'FullName',
        'EmailId',
        'MobileNumber',
        'Subject',
        'Description',
        'Status',
    ];
}

