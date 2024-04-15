<?php

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default('active');
            $table->foreignIdFor(Customer::class);
            $table->foreignIdFor(User::class);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('vat')->default(0);
            $table->string('credit')->nullable();
            $table->string('debit')->nullable();
            $table->string('total_debit')->nullable();
            $table->string('balance')->nullable();
            $table->string('reference_code')->nullable();
            $table->text('property_details')->nullable();
            $table->text('doc_no')->nullable();
            $table->text('note')->nullable()->comment('Addition Info');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
