<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('sport_batches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            
            $table->string('batch_year', 10);
            $table->string('batch_name', 50);
            $table->string('status', 20)->index();

            $table->timestamps(); 
            $table->softDeletes(); 

            $table->index(['batch_year', 'batch_name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sport_batches');
    }
}
