<?php use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

	           Schema::dropIfExists('sport_fee_master');

        Schema::create('sport_fee_master', function (Blueprint $table) {
            $table->id();
            $table->string('series', 50)->nullable(); 
            $table->unsignedBigInteger('organization_id')->nullable()->index(); 
            $table->unsignedBigInteger('group_id')->nullable()->index(); 
            $table->unsignedBigInteger('company_id')->nullable()->index(); 
            $table->unsignedBigInteger('book_id')->nullable();
            $table->string('document_number', 100); 
            $table->date('document_date')->nullable();
            $table->enum('doc_number_type', ['Auto', 'Manually'])->nullable();
            $table->enum('doc_reset_pattern', ['Never', 'Yearly', 'Quarterly', 'Monthly'])->nullable();
            $table->string('doc_prefix', 50)->nullable(); 
            $table->string('doc_suffix', 50)->nullable(); 
            $table->integer('doc_no')->nullable();
            $table->string('document_status', 50)->nullable(); 
            $table->integer('approval_level')->nullable();
            $table->string('revision_number', 50)->nullable();
            $table->integer('revision_date')->nullable();
            $table->string('schedule_no', 50)->nullable(); 
            $table->year('admission_year')->nullable();
            $table->string('sport_name', 100);
            $table->string('display', 50)->nullable();
            $table->string('batch', 50); 
            $table->unsignedBigInteger('batch_id')->index(); 
            $table->string('batch_year', 4)->nullable(); 
            $table->string('section', 50); 
            $table->unsignedBigInteger('section_id')->index(); 
            $table->string('quota', 50); 
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status');
            $table->longText('fee_details');
            $table->timestamps();
            $table->softDeletes();

            
          
            $table->foreign('batch_id')->references('id')->on('sport_batches')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sport_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_fee_master');
    }
};
