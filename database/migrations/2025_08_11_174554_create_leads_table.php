<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_id')->unique()->nullable();
            $table->enum('lead_concern', ['World Flight Travels', 'Flyori Travel']);
            $table->enum('lead_type', ['individual', 'agent']);
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('passport')->unique()->nullable();
            $table->json('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('country');
            $table->string('address');
            $table->string('job_role')->nullable();
            $table->string('age')->nullable();
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->json('follow_up')->nullable();
            $table->string('assign_user');
            $table->longText('note')->nullable();
            $table->enum('status', ['Booked', 'Droped', 'On Process', 'Converted', 'Rejected', 'Need to Follow', 'Passport New', 'Payment New']);
            $table->enum('priority', ['VIP', 'Low Priority', 'Medium Priority', 'High Priority']);
            $table->enum('source', ['agent', 'facebook', 'youtube', 'google', 'whatsapp', 'instagram', 'tiktok', 'imo', 'referral', 'walk-in', 'digital_marketing'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
