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
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('payment_method', ['cash_on_delivery', 'bank_transfer'])->after('status');
            $table->enum('delivery_status', ['waiting', 'packaged', 'shipped', 'delivered'])
                ->default('waiting')
                ->after('payment_method');
            $table->string('no_resi')->nullable()->after('product_status');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'delivery_status', 'no_resi']);
        });
    }
};
