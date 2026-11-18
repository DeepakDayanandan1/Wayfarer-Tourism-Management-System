<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'tblissues';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'UserEmail',
        'Issue',
        'Description',
        'AdminRemark',
        'AdminremarkDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserEmail', 'EmailId');
    }
}

