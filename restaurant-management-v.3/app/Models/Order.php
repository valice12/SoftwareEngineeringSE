<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $table = 'orders';

    // Primary Key (opsional, jika bukan 'id')
    protected $primaryKey = 'id';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'name',
        'productId',   
        'payment',  
        'type',
        'status',    
        'price'
    ];
    public $timsstamps = true;

    public function product() {
        return $this->belongsTo(product::class, 'product_id', 'custom_id');
    }
}