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
        Schema::create('sport_activity_scheduler', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->nullable()->index(); 
            $table->bigInteger('group_id')->nullable()->index(); 
            $table->bigInteger('company_id')->nullable()->index(); 
            $table->string('sport', 50);
            $table->string('batch_year', 10); 
            $table->string('batch_name', 50);
            $table->string('section', 50); 
            $table->string('group',50)->nullable(); 
            $table->string('trainer', 50); 
            $table->string('activity', 50); 
            $table->string('sub_activities', 255)->nullable(); 
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('day');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('remarks', 255); 
            $table->string('status', 20)->index(); 
            $table->longText('batch_student')->nullable();
            $table->integer('scheduler_no');
            $table->softDeletes();
            $table->timestamps();
            
         
            $table->index('sport');
            $table->index('batch_year');
            $table->index('batch_name');
            $table->index('section');
            $table->index('trainer');
            $table->index('activity');
            $table->index('start_date');
            $table->index('end_date');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_activity_scheduler');
    }
};
