<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transactiondetail';
    
    public function transactionHeader()
    {
        return $this->belongsTo(TransactionHeader::class, 'transactionID');
    }
    
    public function menu()
    {
        return $this->belongsTo(MsMenu::class, 'menuID', 'menuID');
    }
}