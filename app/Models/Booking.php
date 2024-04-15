<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'type',
        'status',
        'customer_id',
        'user_id',
        'start_at',
        'end_at',
        'vat',
        'credit',
        'debit',
        'total_debit',
        'balance',
        'reference_code',
        'property_details',
        'doc_no',
        'note',
    ];
    
}
