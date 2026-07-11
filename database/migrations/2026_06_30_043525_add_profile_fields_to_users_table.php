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

            $table->string('photo')->nullable()->after('password');

            $table->string('phone')->nullable()->after('photo');

            $table->text('address')->nullable()->after('phone');

            $table->string('city')->nullable()->after('address');

            $table->string('province')->nullable()->after('city');

            $table->string('postal_code')->nullable()->after('province');

            $table->enum('gender', [
                'Laki-laki',
                'Perempuan'
            ])->nullable()->after('postal_code');

            $table->date('birth_date')->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'photo',
                'phone',
                'address',
                'city',
                'province',
                'postal_code',
                'gender',
                'birth_date',
            ]);

        });
    }
};