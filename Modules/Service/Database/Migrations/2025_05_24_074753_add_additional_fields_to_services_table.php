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
        Schema::table('services', function (Blueprint $table) {
            $table->decimal('fees_amount', 8, 2)->default(0)->after('price');
            $table->json('fees')->nullable()->after('fees_amount');
            $table->string('payment_method')->after('fees');
            $table->string('payment_status')->default('pending')->after('payment_method');
            $table->string('transaction_id')->nullable()->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('fees_amount');
            $table->dropColumn('fees');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
            $table->dropColumn('transaction_id');
        });
    }
};
