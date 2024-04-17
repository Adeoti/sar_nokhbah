<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{record}/pdf/download', [InvoiceController::class, 'hotelBookingInvoice'])->name('hotel_booking.pdf.download');