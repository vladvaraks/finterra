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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id_out')->constrained('wallets');
            $table->foreignId('wallet_id_in')->constrained('wallets');;
            $table->index('wallet_id_out');
            $table->index(['wallet_id_out', 'flag_transfer']);
            $table->index(['transfer_start_datetime', 'flag_transfer']);
            $table->decimal('transfer_amount', 12, 2);
            $table->datetime('transfer_start_datetime');
            $table->boolean('flag_transfer')->default(False);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
