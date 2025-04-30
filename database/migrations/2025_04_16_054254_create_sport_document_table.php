<?php use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportDocumentTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sport_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id')->index();
            $table->string('id_proof', 100)->nullable(); 
            $table->string('aadhar_card', 100)->nullable(); 
            $table->string('parent_aadhar', 100)->nullable(); 
            $table->string('birth_certificate',100)->nullable(); 
            $table->string('medical_record', 100)->nullable(); 
            
          
            $table->timestamps(); 
            

            $table->foreign('registration_id')->references('id')->on('sport_registers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_document');
    }
}
