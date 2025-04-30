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

                Schema::dropIfExists('sport_registers');

        Schema::create('sport_registers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->index(); 
            $table->unsignedBigInteger('group_id')->nullable()->index(); 
            $table->unsignedBigInteger('company_id')->nullable()->index(); 
            $table->unsignedBigInteger('book_id')->nullable();
            $table->string('document_number', 100);
            $table->date('document_date')->nullable();
            $table->enum('doc_number_type', ['Auto', 'Manually'])->default('Manually');
            $table->enum('doc_reset_pattern', ['Never', 'Yearly', 'Quarterly', 'Monthly'])->nullable();
            $table->string('doc_prefix', 50)->nullable(); 
            $table->string('doc_suffix', 50)->nullable(); 
            $table->integer('doc_no')->nullable();
            $table->string('document_status', 50)->nullable();
            $table->integer('approval_level')->default(1);
            $table->string('revision_number', 50)->nullable();
            $table->date('revision_date')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('userable_id');
            $table->string('type', 100)->nullable();
            $table->date('interaction_date')->nullable();
            $table->unsignedBigInteger('sport_id')->index(); 
            $table->unsignedBigInteger('quota_id')->index(); 
            $table->date('dob');
            $table->date('doj')->nullable();
            $table->string('status', 50)->nullable(); 
            $table->string('mobile_number', 20)->nullable();
            $table->string('email', 100)->nullable(); 
            $table->unsignedBigInteger('batch_id')->nullable()->index(); 
            $table->unsignedBigInteger('section_id')->nullable()->index(); 
            $table->string('group', 50)->nullable(); 
            $table->string('bai_id', 50)->nullable(); 
            $table->string('bai_state', 100)->nullable(); 
            $table->string('bwf_id', 50)->nullable();
            $table->string('country', 100)->nullable(); 
            $table->longText('image')->nullable();
            $table->enum('hostel_required', ['Yes', 'No'])->nullable();
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->string('room_preference', 100)->nullable(); 
            $table->string('gender', 10)->nullable(); 
            $table->string('middle_name', 100)->nullable(); 
            $table->string('last_name', 100)->nullable(); 
            $table->longText('remarks')->nullable();
            $table->string('registration_number', 100)->nullable(); 
            $table->longText('fee_details')->nullable();
            $table->integer('fee_batch_id')->nullable();
            $table->integer('fee_section_id')->nullable();
            $table->longText('payment_reason')->nullable();

             $table->timestamps();
         
             $table->foreign('sport_id')->references('id')->on('sports_master')->onDelete('cascade');
            $table->foreign('quota_id')->references('id')->on('sport_quotas')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('sport_batches')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sport_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_registers');
    }
};
