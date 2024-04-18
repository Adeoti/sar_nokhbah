<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Faker\Core\Number;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\SiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    //




public function hotelBookingInvoice(Booking $record){



//Get Customer's Info
$customer = Customer::find($record->customer_id);

$customerName = $customer->name;
$customerPhone = $customer->phone_number;
$customerCountry = $customer->country;
$customerEmail = $customer->email;




//Get Hotel Details


$hotel = Hotel::find($record->hotel_id);
    $hotel_name = $hotel->name;
    $hotel_stars = $hotel->stars;
    $hotel_address = $hotel->address;


    //Booking Info
    $start_at = $record->start_at;
    $end_at = $record->end_at;
    $debit = $record->debit;
    $total_debit = $record->total_debit;
    $vat = $record->vat;
    $status = $record->status;





    $appSettings = SiteSetting::first();

    $appLanguage = $appSettings->language;



$client = new Party([
    'name'          => 'Nokhbat Al-Jawahir',
    'phone'         => '+966558290031',
    'custom_fields' => [
        'email'        => 'nokhbagems@gmail.com',
        'address' => 'Ummul-Juud, Opposite Sasco Filling Station, Makkah',
    ],
]);

$customer = new Party([
    'name'          => $customerName,
    'phone'       => $customerPhone,
    'custom_fields' => [
        'country' => $customerCountry,
        'email' => $customerEmail,
    ],
]);

$items = [
    InvoiceItem::make($hotel_name)
        ->description(strip_tags($hotel_address))
        ->checkin($start_at)
        ->checkout($end_at)

        // ->price(number_format($debit,2))
        // ->vat(number_format($vat,2))
        // ->total(number_format($total_debit,2))

        ->price((float)$debit,2)
        ->vat((float)$vat,2)
        ->total((float)$total_debit,2)

        ->pricePerUnit(47.79)
        
   
];

$notes = [
    'Hotel Name: '. $hotel_name,
    'Hotel Rank: '.$hotel_stars,
    'Address: '.strip_tags($hotel_address)
];
$notes = implode("<br>", $notes);




    $invoiceLabel = "";

    switch($appLanguage){
        case 'ar':
            $invoiceLabel = "الفاتورة";
        break;

        case 'en':
            $invoiceLabel = "Invoice";
        break;
    }

$invoice = Invoice::make('invoice')
    
    ->series('BIG')
    // ability to include translated invoice status
    // in case it was paid
    ->status(__($status))
    ->sequence(667)
    ->serialNumberFormat($record->reference_code)
    ->seller($client)
    ->buyer($customer)
    ->date($record->created_at)
    ->dateFormat('D M m/d/Y')
    ->currencySymbol(SiteSetting::first()->currency)
    ->currencyCode(SiteSetting::first()->currency)
    ->currencyFormat('{SYMBOL}{VALUE}')
    ->currencyThousandsSeparator('.')
    ->currencyDecimalPoint(',')
    ->filename($client->name . ' ' . $customer->name)
    ->addItems($items)
    ->notes($notes)
    ->logo(public_path('vendor/invoices/logo.jpeg'))
    // You can additionally save generated invoice to configured disk
    ->save('public')
    
    ;

$link = $invoice->url();
// Then send email to party with link



// And return invoice itself to browser or have a different view
return $invoice->stream();


}


public function kitchenBookingInvoice(Booking $record){



//Get Customer's Info
$customer = Customer::find($record->customer_id);

$customerName = $customer->name;
$customerPhone = $customer->phone_number;
$customerCountry = $customer->country;
$customerEmail = $customer->email;




//Get Hotel Details


//$hotel = Hotel::find($record->hotel_id);
    $hotel_name = $record->note;
    $hotel_stars = "";
    $hotel_address = "";


    //Booking Info
    $start_at = $record->start_at;
    $end_at = $record->end_at;
    $debit = $record->debit;
    $total_debit = $record->total_debit;
    $vat = $record->vat;
    $status = $record->status;





    $appSettings = SiteSetting::first();

    $appLanguage = $appSettings->language;



$client = new Party([
    'name'          => 'Nokhbat Al-Jawahir',
    'phone'         => '+966558290031',
    'custom_fields' => [
        'email'        => 'nokhbagems@gmail.com',
        'address' => 'Ummul-Juud, Opposite Sasco Filling Station, Makkah',
    ],
]);

$customer = new Party([
    'name'          => $customerName,
    'phone'       => $customerPhone,
    'custom_fields' => [
        'country' => $customerCountry,
        'email' => $customerEmail,
    ],
]);


    $hotel_name = strip_tags($hotel_name);

$items = [
    InvoiceItem::make($hotel_name)
        ->description(strip_tags($hotel_address))
        ->checkin($start_at)
        ->checkout($end_at)

        // ->price(number_format($debit,2))
        // ->vat(number_format($vat,2))
        // ->total(number_format($total_debit,2))

        ->price((float)$debit,2)
        ->vat((float)$vat,2)
        ->total((float)$total_debit,2)

        ->pricePerUnit(47.79)
        
   
];

$notes = [
    'Hotel Name: '. $hotel_name,
    'Hotel Rank: '.$hotel_stars,
    'Address: '.strip_tags($hotel_address)
];
$notes = implode("<br>", $notes);




    $invoiceLabel = "";

    switch($appLanguage){
        case 'ar':
            $invoiceLabel = "الفاتورة";
        break;

        case 'en':
            $invoiceLabel = "Invoice";
        break;
    }

$invoice = Invoice::make('invoice')
    
    ->series('BIG')
    // ability to include translated invoice status
    // in case it was paid
    ->status(__($status))
    ->sequence(667)
    ->serialNumberFormat($record->reference_code)
    ->seller($client)
    ->buyer($customer)
    ->template('kitchen')
    ->date($record->created_at)
    ->dateFormat('D M m/d/Y')
    ->currencySymbol(SiteSetting::first()->currency)
    ->currencyCode(SiteSetting::first()->currency)
    ->currencyFormat('{SYMBOL}{VALUE}')
    ->currencyThousandsSeparator('.')
    ->currencyDecimalPoint(',')
    ->filename($client->name . ' ' . $customer->name)
    ->addItems($items)
  
    ->logo(public_path('vendor/invoices/logo.jpeg'))
    // You can additionally save generated invoice to configured disk
    ->save('public')
    
    ;

$link = $invoice->url();
// Then send email to party with link



// And return invoice itself to browser or have a different view
return $invoice->stream();


}
public function TransportationBookingInvoice(Booking $record){



//Get Customer's Info
$customer = Customer::find($record->customer_id);

$customerName = $customer->name;
$customerPhone = $customer->phone_number;
$customerCountry = $customer->country;
$customerEmail = $customer->email;




//Get Hotel Details


//$hotel = Hotel::find($record->hotel_id);
    $hotel_name = $record->note;
    $hotel_stars = "";
    $hotel_address = "";


    //Booking Info
    $start_at = $record->start_at;
    $end_at = $record->end_at;
    $debit = $record->debit;
    $total_debit = $record->total_debit;
    $vat = $record->vat;
    $status = $record->status;





    $appSettings = SiteSetting::first();

    $appLanguage = $appSettings->language;



$client = new Party([
    'name'          => 'Nokhbat Al-Jawahir',
    'phone'         => '+966558290031',
    'custom_fields' => [
        'email'        => 'nokhbagems@gmail.com',
        'address' => 'Ummul-Juud, Opposite Sasco Filling Station, Makkah',
    ],
]);

$customer = new Party([
    'name'          => $customerName,
    'phone'       => $customerPhone,
    'custom_fields' => [
        'country' => $customerCountry,
        'email' => $customerEmail,
    ],
]);


    $hotel_name = strip_tags($hotel_name);

$items = [
    InvoiceItem::make($hotel_name)
        ->description(strip_tags($hotel_address))
        ->checkin($start_at)
        ->checkout($end_at)

        // ->price(number_format($debit,2))
        // ->vat(number_format($vat,2))
        // ->total(number_format($total_debit,2))

        ->price((float)$debit,2)
        ->vat((float)$vat,2)
        ->total((float)$total_debit,2)

        ->pricePerUnit(47.79)
        
   
];

$notes = [
    'Hotel Name: '. $hotel_name,
    'Hotel Rank: '.$hotel_stars,
    'Address: '.strip_tags($hotel_address)
];
$notes = implode("<br>", $notes);




    $invoiceLabel = "";

    switch($appLanguage){
        case 'ar':
            $invoiceLabel = "الفاتورة";
        break;

        case 'en':
            $invoiceLabel = "Invoice";
        break;
    }

$invoice = Invoice::make('invoice')
    
    ->series('BIG')
    // ability to include translated invoice status
    // in case it was paid
    ->status(__($status))
    ->sequence(667)
    ->serialNumberFormat($record->reference_code)
    ->seller($client)
    ->buyer($customer)
    ->template('kitchen')
    ->date($record->created_at)
    ->dateFormat('D M m/d/Y')
    ->currencySymbol(SiteSetting::first()->currency)
    ->currencyCode(SiteSetting::first()->currency)
    ->currencyFormat('{SYMBOL}{VALUE}')
    ->currencyThousandsSeparator('.')
    ->currencyDecimalPoint(',')
    ->filename($client->name . ' ' . $customer->name)
    ->addItems($items)
  
    ->logo(public_path('vendor/invoices/logo.jpeg'))
    // You can additionally save generated invoice to configured disk
    ->save('public')
    
    ;

$link = $invoice->url();
// Then send email to party with link



// And return invoice itself to browser or have a different view
return $invoice->stream();


}


    
}
