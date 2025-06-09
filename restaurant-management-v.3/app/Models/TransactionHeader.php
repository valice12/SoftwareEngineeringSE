<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    protected $table = 'transactionheader';
    protected $primaryKey = 'transactionID';
    
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transactionID');
    }
}
