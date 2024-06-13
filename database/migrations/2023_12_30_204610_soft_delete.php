<?php

declare(strict_types=1);

use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Transfer;
use Bavix\Wallet\Models\Wallet;
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
        Schema::table((new Wallet())->getTable(), static function (Blueprint $table) {
            $table->softDeletesTz();
        });
        Schema::table((new Transfer())->getTable(), static function (Blueprint $table) {
            $table->softDeletesTz();
        });
        Schema::table((new Transaction())->getTable(), static function (Blueprint $table) {
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table((new Wallet())->getTable(), static function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table((new Transfer())->getTable(), static function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table((new Transaction())->getTable(), static function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
