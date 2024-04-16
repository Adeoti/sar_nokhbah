<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
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



    public function hotel(): BelongsTo{
        return $this->belongsTo(Hotel::class);
    }

    

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
}
