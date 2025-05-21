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
        Schema::create('sport_screening_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->date('screening_date');
            $table->integer('batch_year');
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('sports_group_id');
            $table->unsignedBigInteger('registration_id');
            $table->unsignedBigInteger('screening_id');

            $table->longText('parameter_values')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes (as per your SQL dump)
            $table->index('id', 'sport_screening_details_id_index');
            $table->index('organization_id', 'sport_screening_details_organization_id_index');
            $table->index('group_id', 'sport_screening_details_group_id_index');
            $table->index('company_id', 'sport_screening_details_company_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_screening_details');
    }

};
