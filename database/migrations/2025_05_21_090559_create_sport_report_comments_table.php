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
        Schema::create('sport_report_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->date('screening_date');
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('registration_id');
            $table->json('remark'); // This will ensure it's valid JSON

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('id', 'sport_screening_details_id_index');
            $table->index('organization_id', 'sport_screening_details_organization_id_index');
            $table->index('group_id', 'sport_screening_details_group_id_index');
            $table->index('company_id', 'sport_screening_details_company_id_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sport_report_comments');
    }

};
