<?php use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_master_group', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->nullable();
            $table->bigInteger('group_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('name', 50);
            $table->string('batch_year', 10); 
            $table->unsignedBigInteger('batch_id')->index();
            $table->unsignedBigInteger('section_id')->index();
            $table->string('batch_name', 50)->index(); 
            $table->string('section_name', 50)->index();
            $table->string('status',20)->default('active')->index(); 
            
            
            $table->timestamps();
            $table->softDeletes();

           
            $table->foreign('batch_id')->references('id')->on('sport_batches')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sport_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sport_master_group');
    }
};
