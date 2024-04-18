<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{record}/pdf/download/hotel', [InvoiceController::class, 'hotelBookingInvoice'])->name('hotel_booking.pdf.download');
Route::get('/{record}/pdf/download/kitchen', [InvoiceController::class, 'kitchenBookingInvoice'])->name('kitchen_booking.pdf.download');
Route::get('/{record}/pdf/download/transportation', [InvoiceController::class, 'TransportationBookingInvoice'])->name('transportation_booking.pdf.download');