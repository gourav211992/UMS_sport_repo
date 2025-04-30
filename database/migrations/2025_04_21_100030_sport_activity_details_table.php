<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
	    Schema::dropIfExists('sport_activity_details');

        Schema::create('sport_activity_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->nullable()->index(); 
            $table->bigInteger('group_id')->nullable()->index(); 
            $table->bigInteger('company_id')->nullable()->index(); 
            $table->unsignedBigInteger('scheduler_id');
            $table->date('date');
            $table->json('students'); 
            $table->timestamps();
            $table->foreign('scheduler_id')->references('id')->on('sport_activity_scheduler')->onDelete('cascade');
     
            $table->index('date'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('sport_activity_details');
    }
};
