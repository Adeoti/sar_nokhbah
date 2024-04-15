<?php

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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean('currency')->default(false)->comment('permission');
            $table->boolean('language')->default(false)->comment('permission');
            $table->boolean('config')->default(false)->comment('permission');
            //
            $table->boolean('can_view_user')->default(false)->comment('permission');
            $table->boolean('can_add_user')->default(false)->comment('permission');
            $table->boolean('can_edit_user')->default(false)->comment('permission');
            $table->boolean('can_delete_user')->default(false)->comment('permission');
            //
            $table->boolean('can_view_customer')->default(false)->comment('permission');
            $table->boolean('can_add_customer')->default(false)->comment('permission');
            $table->boolean('can_edit_customer')->default(false)->comment('permission');
            $table->boolean('can_delete_customer')->default(false)->comment('permission');
            //
            $table->boolean('can_view_hotel')->default(false)->comment('permission');
            $table->boolean('can_add_hotel')->default(false)->comment('permission');
            $table->boolean('can_edit_hotel')->default(false)->comment('permission');
            $table->boolean('can_delete_hotel')->default(false)->comment('permission');
            //
            $table->boolean('can_view_expense')->default(false)->comment('permission');
            $table->boolean('can_add_expense')->default(false)->comment('permission');
            $table->boolean('can_edit_expense')->default(false)->comment('permission');
            $table->boolean('can_delete_expense')->default(false)->comment('permission');
            //
            $table->boolean('can_book_hotel')->default(false)->comment('permission');
            $table->boolean('can_book_transportation')->default(false)->comment('permission');
            $table->boolean('can_book_kitchen')->default(false)->comment('permission');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('currency');
            $table->dropColumn('language');
            $table->dropColumn('config');
            $table->dropColumn('can_view_user');
            $table->dropColumn('can_add_user');
            $table->dropColumn('can_edit_user');
            $table->dropColumn('can_delete_user');
            $table->dropColumn('can_view_customer');
            $table->dropColumn('can_add_customer');
            $table->dropColumn('can_edit_customer');
            $table->dropColumn('can_delete_customer');
            $table->dropColumn('can_view_hotel');
            $table->dropColumn('can_add_hotel');
            $table->dropColumn('can_edit_hotel');
            $table->dropColumn('can_delete_hotel');
            $table->dropColumn('can_view_expense');
            $table->dropColumn('can_add_expense');
            $table->dropColumn('can_edit_expense');
            $table->dropColumn('can_delete_expense');
            $table->dropColumn('can_book_hotel');
            $table->dropColumn('can_book_transportation');
            $table->dropColumn('can_book_kitchen');
        });
    }
};
