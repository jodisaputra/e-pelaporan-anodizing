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
        Schema::create('actions', function (Blueprint $table) {
            $table->id('action_id');
            $table->string('action_status');
            $table->text('action_description');
            $table->date('action_date');
            $table->string('technician_name');
            $table->unsignedBigInteger('spare_part_id');
            $table->integer('spare_part_quantity');
            $table->timestamps();

            $table->foreign('spare_part_id')->references('id')->on('spare_parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
