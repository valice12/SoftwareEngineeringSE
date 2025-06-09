<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffPosition extends Model
{
    protected $table = 'staffPosition';
    protected $primaryKey = 'staffPositionID';
    
    protected $fillable = [
        'staffPosition'
    ];
}
