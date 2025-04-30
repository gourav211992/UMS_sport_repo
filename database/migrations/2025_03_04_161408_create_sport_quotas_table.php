<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportQuotasTable extends Migration
{
    public function up()
    {
        Schema::create('sport_quotas', function (Blueprint $table) {
            $table->id();

           
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

        
            $table->string('quota_name', 100)->index();
            $table->string('display_name', 50);
            $table->decimal('discount', 5, 2)->nullable();
            $table->string('status', 20)->index(); 

            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sport_quotas');
    }
}
