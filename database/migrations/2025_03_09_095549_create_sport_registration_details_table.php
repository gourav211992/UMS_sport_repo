<?php use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sport_registration_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id')->index(); 

            $table->string('badminton_experience', 100)->nullable(); 
            $table->string('highest_achievement', 100)->nullable();
            $table->string('level_of_play', 100)->nullable(); 
            $table->text('medical_conditions')->nullable();
            $table->text('current_medications')->nullable();
            $table->text('dietary_restrictions')->nullable();
            $table->string('blood_group', 5)->nullable();
            $table->timestamps();
            $table->foreign('registration_id')->references('id')->on('sport_registers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sport_registration_details');
    }
};
