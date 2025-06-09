<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MsStaff extends Authenticatable
{
    protected $table = 'msstaff';
    protected $primaryKey = 'staffID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'staffID',
        'staffName',
        'staffEmail',
        'staffPositionID', 
        'staffPassword'
    ];

    protected $hidden = ['staffPassword'];

    public function getAuthPassword()
    {
        return $this->staffPassword;
    }

    public function position()
    {
        return $this->belongsTo(StaffPosition::class, 'staffPositionID', 'staffPositionID');
    }
    
    public function getPositionNameAttribute()
    {
        return $this->position ? $this->position->staffPosition : 'Belum Ada Posisi';
    }
}
