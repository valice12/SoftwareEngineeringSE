<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsMenu extends Model
{
    protected $table = 'msmenu';
    protected $primaryKey = 'menuID';
    
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'menuID');
    }

    protected $fillable = [
        'menuID',
        'menuName',
        'menuPrice',
        'menuType'
    ];
    
}