<?php use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportFamilyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sport_family_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id')->index(); 
            $table->string('relation', 50)->nullable();
            $table->string('name', 100)->nullable(); 
            $table->string('contact_no', 20)->nullable(); 
            $table->string('email', 254)->nullable(); 

            $table->string('permanent_street1', 255)->nullable();
            $table->string('permanent_street2', 255)->nullable();
            $table->string('permanent_town', 100)->nullable();
            $table->string('permanent_district', 100)->nullable();
            $table->string('permanent_state', 100)->nullable();
            $table->string('permanent_country', 100)->nullable();
            $table->string('permanent_pincode', 20)->nullable();

            $table->string('correspondence_street1', 255)->nullable();
            $table->string('correspondence_street2', 255)->nullable();
            $table->string('correspondence_town', 100)->nullable();
            $table->string('correspondence_district', 100)->nullable();
            $table->string('correspondence_state', 100)->nullable();
            $table->string('correspondence_country', 100)->nullable();
            $table->string('correspondence_pincode', 20)->nullable();

            $table->boolean('is_guardian')->default(0);
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('sport_registers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_family_details');
    }
}
