<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->boolean('is_invited')->default(false)->after('submission_token');
            $table->string('economy')->nullable()->change();
            $table->string('attending_as')->nullable()->change();
            $table->string('nationality')->nullable()->change();
            $table->string('passport_type')->nullable()->change();
            $table->string('passport_number')->nullable()->change();
            $table->date('passport_expiry')->nullable()->change();
            $table->string('visa_status')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('economy')->nullable(false)->change();
            $table->string('attending_as')->nullable(false)->change();
            $table->string('nationality')->nullable(false)->change();
            $table->string('passport_type')->nullable(false)->change();
            $table->string('passport_number')->nullable(false)->change();
            $table->date('passport_expiry')->nullable(false)->change();
            $table->string('visa_status')->nullable(false)->change();
            $table->dropColumn('is_invited');
        });
    }
};
