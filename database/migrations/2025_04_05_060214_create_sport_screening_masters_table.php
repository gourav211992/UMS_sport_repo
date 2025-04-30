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
        Schema::create('sport_screening_masters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->nullable()->index(); 
            $table->bigInteger('group_id')->nullable()->index(); 
            $table->bigInteger('company_id')->nullable()->index(); 
            $table->unsignedBigInteger('sport_id')->index(); 
            $table->string('screening_name', 100)->index(); 
            $table->text('description')->nullable();
            $table->string('status', 20)->index(); 
            $table->json('parameter_details')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sport_id')->references('id')->on('sports_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_screening_masters');
    }
};
