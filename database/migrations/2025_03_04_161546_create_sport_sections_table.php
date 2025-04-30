<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('sport_sections', function (Blueprint $table) {
            $table->id();

            // Optional references
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            
            $table->string('name', 50);
            $table->string('year', 10);
            $table->string('batch', 50);
            $table->unsignedBigInteger('batch_id')->nullable()->index();

            $table->string('status', 20)->index();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['year', 'batch']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sport_sections');
    }
}
