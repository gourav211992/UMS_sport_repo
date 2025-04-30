<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sport_training_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id');
            $table->string('previous_coach')->nullable();
            $table->string('training_academy')->nullable();
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('sport_registers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sport_training_details');
    }
};

