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
        Schema::create('sports_activity_master', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->nullable()->index(); 
            $table->bigInteger('group_id')->nullable()->index(); 
            $table->bigInteger('company_id')->nullable()->index(); 
            $table->string('sport_id', 10); 
            $table->string('activity_name', 50); 
            $table->json('sub_activities'); 
            $table->string('duration_min', 10); 
            $table->string('description', 500)->nullable(); 
            $table->string('status', 20); 
            $table->softDeletes();
            $table->timestamps();

            
            $table->index('sport_id'); 
            $table->index('activity_name'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports_activity_master');
    }
};
