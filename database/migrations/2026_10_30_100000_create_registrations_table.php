<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_other')->nullable();
            $table->string('full_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('economy');
            $table->string('organization');
            $table->string('position');
            $table->string('attending_as');
            $table->string('nationality');
            $table->string('passport_type');
            $table->string('passport_number');
            $table->date('passport_expiry');
            $table->string('passport_copy_path');
            $table->string('visa_status');
            $table->string('visa_status_other')->nullable();
            $table->json('sessions');
            $table->dateTime('arrival_at')->nullable();
            $table->string('arrival_flight')->nullable();
            $table->dateTime('departure_at')->nullable();
            $table->string('departure_flight')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('dietary');
            $table->string('dietary_other')->nullable();
            $table->string('accessibility');
            $table->boolean('consent');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
