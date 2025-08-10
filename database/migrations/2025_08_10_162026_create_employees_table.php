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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('id_card')->unique();
            $table->string('name');
            $table->string('department');
            $table->string('designation');
            $table->string('blood', 3); 
            $table->double('salary', 10, 2);
            $table->double('commission', 8, 2)->default(0);
            $table->string('email')->unique();
            $table->string('mobile', 11);
            $table->date('birth_date');
            $table->date('appointment_date');
            $table->date('join_date');
            $table->longText('address')->nullable();
            $table->tinyInteger('status')
                ->default(0)
                ->comment('1 => active, 0 => inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
