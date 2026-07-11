<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('payments', 'invoice')) {
            // Kolom belum ada -> buat baru dengan nullable agar aman
            Schema::table('payments', function (Blueprint $table) {
                $table->string('invoice')->nullable()->unique()->after('id');
            });
        } else {
            // Kolom sudah ada (dibuat manual sebelumnya) tapi NOT NULL tanpa default
            // -> ubah jadi nullable supaya tidak lagi memicu error saat insert
            DB::statement('ALTER TABLE payments MODIFY invoice VARCHAR(255) NULL');
        }

        // Isi invoice untuk baris lama yang masih kosong, supaya tetap unik
        DB::table('payments')->whereNull('invoice')->orWhere('invoice', '')->orderBy('id')->get()->each(function ($payment) {
            DB::table('payments')->where('id', $payment->id)->update([
                'invoice' => 'INV-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT) . '-' . strtoupper(uniqid()),
            ]);
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('payments', 'invoice')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropColumn('invoice');
            });
        }
    }
};
