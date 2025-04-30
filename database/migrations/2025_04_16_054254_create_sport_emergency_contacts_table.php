<?php use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sport_emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id')->index();
            $table->string('name', 50); 
            $table->string('relation', 50); 
            $table->string('contact_no', 20); 
            $table->string('email')->nullable(); 
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('sport_registers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_emergency_contacts');
    }
}
